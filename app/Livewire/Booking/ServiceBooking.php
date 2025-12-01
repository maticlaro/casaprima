<?php

namespace App\Livewire\Booking;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceParameterOption;
use App\Services\SchedulingService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Form as SchemaForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Tapp\FilamentGoogleAutocomplete\Forms\Components\GoogleAutocomplete;


class ServiceBooking extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public Service $service;

    #[Url]
    public ?string $date = null;

    public array $selectedOptions = [];

    public array $slots = [];

    /**
     * Options for the ToggleButtons control: [ isoString => 'HH:mm' ]
     *
     * @var array<string,string>
     */
    public array $slotOptions = [];

    /**
     * Dates to disable in the DatePicker, as 'Y-m-d' strings.
     *
     * @var array<int,string>
     */
    public array $disabledDates = [];

    public int $quote = 0; // CLP

    public ?array $data = [];

    public bool $showRegistrationForm = false;

    protected $listeners = [
        'customer-registered' => 'onCustomerRegistered',
        'registration-cancelled' => 'onRegistrationCancelled',
    ];

    public function mount(Service $service): void
    {
        $this->service = $service;

        // Find the earliest available date
        $earliestAvailableDate = $this->findEarliestAvailableDate();

        if (empty($this->date)) {
            $this->date = $earliestAvailableDate;
        }

        $this->form->fill([
            'date' => $this->date,
        ]);

        $this->recalculate();
    }

    public function form(Schema $schema): Schema
    {
        $tz = config('company.timezone', 'America/Santiago');

        $parameterSelects = [];
        $params = $this->service->serviceParameters()->with('serviceParameterOptions')->get();
        foreach ($params as $parameter) {
            $parameterSelects[] = Select::make("selectedOptions.{$parameter->id}")
                ->label($parameter->name)
                ->options($parameter->serviceParameterOptions->pluck('option_value', 'id')->all())
                ->native(false)
                ->placeholder('Selecciona una opción')
                ->live()
                ->extraAttributes(['class' => 'mb-8'])
                ->prefixIcon(Heroicon::AdjustmentsHorizontal)
                ->afterStateUpdated(fn () => $this->recalculate())
                ->required();
        }

        return $schema
            ->components([
                SchemaForm::make([
                    Section::make('Dirección')
                        ->extraAttributes(['class' => 'mb-8'])
                        ->schema([
                            GoogleAutocomplete::make('google_search_field')
                            ->countries([
                                'CL',
                            ])
                            
                            ->language('es')
                            ->withFields([
                                TextInput::make('address')
                                    ->extraInputAttributes([
                                        'data-google-field' => '{route} {street_number}',
                                    ]),
                                TextInput::make('country'),
                                TextInput::make('coordinates')
    ]),
                        ]),

                    Section::make('Configuración del servicio')
                        ->schema($parameterSelects)
                        ->columns(1)
                        ->compact(false)

                        ->extraAttributes(['class' => 'mb-8']),

                    Section::make('Fecha y horario')
                        ->schema([
                            DatePicker::make('date')
                                ->required()
                                ->native(false)
                                ->label('Fecha')
                                ->locale('es')
                                ->displayFormat('l d / m / Y')
                                ->minDate(now()->timezone($tz)->toDateString())
                                ->default(fn () => $this->findEarliestAvailableDate())
                                ->disabledDates(fn () => $this->disabledDates)
                                ->live()
                                ->prefixIcon(Heroicon::CalendarDays)
                                ->extraAttributes(['class' => 'mb-8'])
                                ->afterStateUpdated(function ($state) {
                                    $this->date = $state;
                                    $this->recalculate();
                                }),
                            ToggleButtons::make('selectedSlot')
                                ->label('Horarios disponibles')
                                ->options(fn () => $this->slotOptions)
                                ->inline()
                                ->extraAttributes(['class' => 'mb-8'])
                                ->live()
                                ->disabled(fn () => empty($this->slotOptions)),
                        ])
                        ->columns(1)
                        ->compact(false)
                        ->extraAttributes(['class' => 'mb-8']),

                    Section::make('Resumen')
                        ->schema([
                            Placeholder::make('quoteLabel')
                                ->label('Precio estimado')
                                ->content(fn () => '$'.number_format($this->quote, 0, ',', '.').' CLP'),
                        ])
                        ->columns(1)
                        ->compact(false)
                        ->extraAttributes(['class' => 'mb-8']),
                ])
                    ->livewireSubmitHandler('create')
                    ->key('booking-form'),
            ])
            ->statePath('data')
            ->gap('lg');
    }

    public function create(): void
    {


        // Validate the form
        $formData = $this->form->getState();

        // Validate required fields
        if (empty($formData['date'])) {
            $this->addError('date', 'Por favor, selecciona una fecha.');
            return;
        }

        // Ensure a slot is selected
        if (empty($formData['selectedSlot'])) {
            $this->addError('selectedSlot', 'Por favor, selecciona un horario disponible.');
            return;
        }

        // Validate that selected options are valid for this service
        $selectedOptionIds = collect($formData['selectedOptions'] ?? [])->filter()->values();
        if ($selectedOptionIds->isNotEmpty()) {
            $validOptionIds = $this->service->serviceParameters()
                ->with('serviceParameterOptions')
                ->get()
                ->pluck('serviceParameterOptions')
                ->flatten()
                ->pluck('id');

            $invalidOptions = $selectedOptionIds->diff($validOptionIds);
            if ($invalidOptions->isNotEmpty()) {
                $this->addError('selectedOptions', 'Algunas opciones seleccionadas no son válidas para este servicio.');

                return;
            }
        }

        // Parse the selected slot datetime
        $selectedDateTime = Carbon::parse($formData['selectedSlot']);

        // Validate that the selected slot is still available
        if ($selectedDateTime->isPast()) {
            $this->addError('selectedSlot', 'El horario seleccionado ya no está disponible. Por favor, selecciona otro horario.');

            return;
        }

        // Calculate duration based on service and selected options
        $baseDuration = $this->service->base_duration_minutes;
        $durationAdjustment = ServiceParameterOption::whereIn('id', $selectedOptionIds)
            ->sum('duration_minutes_adjustment');
        $totalDuration = $baseDuration + $durationAdjustment;

        // Calculate end datetime
        $endDateTime = $selectedDateTime->copy()->addMinutes($totalDuration);

        // Find an available technician for this slot
        $sched = app(SchedulingService::class);
        $availableTechnician = $sched->findAvailableTechnicianForSlot(
            $this->service,
            $selectedDateTime,
            $endDateTime
        );

        if (! $availableTechnician) {
            $this->addError('selectedSlot', 'No hay técnicos disponibles para este horario. Por favor, selecciona otro horario.');

            return;
        }


        // Prevent guests from creating an appointment
        if (!auth()->check()) {
            $this->showRegistrationForm = true;
            return;
        }

        try {
            // Create the appointment
            $appointment = Appointment::create([
                'service_id' => $this->service->id,
                'technician_id' => $availableTechnician->id,
                'scheduled_start_datetime' => $selectedDateTime,
                'calculated_end_datetime' => $endDateTime,
                'final_price' => $this->quote,
                'status' => 'scheduled',
                'is_emergency' => false,
                'payment_status' => 'pending',
                'is_rated' => false,
            ]);

            // Attach selected service parameter options
            if ($selectedOptionIds->isNotEmpty()) {
                $appointment->serviceParameterOptions()->attach($selectedOptionIds);
            }

            // Clear form data after successful creation
            $this->reset(['data']);

            // Redirect to confirmation page or show success message
            session()->flash('success', '¡Cita agendada exitosamente! Te contactaremos pronto para confirmar los detalles.');

            // Redirect to home or appointment confirmation page
            $this->redirect(route('home'));

        } catch (\Exception $e) {
            $this->addError('form', 'Hubo un error al crear la cita. Por favor, inténtalo de nuevo.');
            logger()->error('Error creating appointment: '.$e->getMessage(), [
                'service_id' => $this->service->id,
                'selected_datetime' => $selectedDateTime,
                'selected_options' => $selectedOptionIds->toArray(),
            ]);
        }
    }

    public function onCustomerRegistered(): void
    {
        $this->showRegistrationForm = false;
        // Try to create the appointment again now that user is registered
        $this->create();
    }

    public function onRegistrationCancelled(): void
    {
        $this->showRegistrationForm = false;
    }

    // Form fields call recalculate() via afterStateUpdated handlers.

    protected function recalculate(): void
    {
        $selectedIds = collect($this->data['selectedOptions'] ?? [])->filter()->values();
        $base = (int) $this->service->base_price;
        $adj = (int) ServiceParameterOption::whereIn('id', $selectedIds)->sum('price_adjustment');
        $this->quote = $base + $adj;

        $sched = app(SchedulingService::class);
        $tz = config('company.timezone', 'America/Santiago');
        $dateToUse = $this->data['date'] ?? $this->date ?? now()->timezone($tz)->toDateString();

        // Update slots and toggle button options for the chosen date
        $slotsForDay = collect($sched->getSlotsForDay($this->service, Carbon::parse($dateToUse, $tz), $selectedIds));
        $this->slots = $slotsForDay
            ->map(fn ($s) => [
                'start' => $s['start']->format('H:i'),
                'end' => $s['end']->format('H:i'),
                'iso' => $s['start']->toIso8601String(),
            ])->all();

        $this->slotOptions = $slotsForDay
            ->mapWithKeys(fn ($s) => [
                $s['start']->toIso8601String() => $s['start']->format('H:i'),
            ])
            ->all();

        // Update disabled dates for the next 60 days based on current selections
        $this->disabledDates = $this->computeDisabledDates($selectedIds, 180);
    }

    /**
     * Compute disabled dates as those with no available slots within the given window.
     *
     * @param  \Illuminate\Support\Collection<int,int>  $selectedIds
     * @return array<int,string>
     */
    protected function computeDisabledDates($selectedIds, int $days = 180): array
    {
        $sched = app(SchedulingService::class);
        $tz = config('company.timezone', 'America/Santiago');
        $start = now()->timezone($tz)->startOfDay();

        $disabled = [];

        for ($i = 0; $i < $days; $i++) {
            $day = $start->copy()->addDays($i);
            $slots = $sched->getSlotsForDay($this->service, $day, collect($selectedIds));
            if (empty($slots)) {
                $disabled[] = $day->toDateString();
            }
        }

        return $disabled;
    }

    /**
     * Find the earliest date with available slots.
     */
    protected function findEarliestAvailableDate(): string
    {
        $sched = app(SchedulingService::class);
        $tz = config('company.timezone', 'America/Santiago');
        $start = now()->timezone($tz)->startOfDay();

        // Check up to 60 days ahead
        for ($i = 0; $i < 60; $i++) {
            $day = $start->copy()->addDays($i);
            $slots = $sched->getSlotsForDay($this->service, $day, collect([]));
            if (! empty($slots)) {
                return $day->toDateString();
            }
        }

        // Fallback to today if no slots found
        return $start->toDateString();
    }

    public function render()
    {
        $parameters = $this->service->serviceParameters()->with('serviceParameterOptions')->get();

        return view('livewire.booking.service-booking', [
            'parameters' => $parameters,
        ])->layout('components.layouts.mainapp');
    }
}
