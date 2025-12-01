<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Livewire\Booking\ServiceBooking;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceParameter;
use App\Models\ServiceParameterOption;
use App\Models\Technician;
use App\Models\TechnicianAvailability;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ServiceBookingTest extends TestCase
{
    use RefreshDatabase;

    protected Service $service;

    protected Technician $technician;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a service with parameters
        $this->service = Service::factory()->create([
            'name' => 'Test Service',
            'base_price' => 50000,
            'base_duration_minutes' => 60,
        ]);

        // Create a technician
        $this->technician = Technician::factory()->create();

        // Attach the service to the technician
        $this->technician->services()->attach($this->service->id);

        // Create technician availability for tomorrow (full day)
        $tomorrow = Carbon::tomorrow();
        TechnicianAvailability::create([
            'technician_id' => $this->technician->id,
            'start_datetime' => $tomorrow->copy()->setTime(8, 0, 0),
            'end_datetime' => $tomorrow->copy()->setTime(18, 0, 0),
        ]);

        // Create service parameters with options
        $parameter = ServiceParameter::create([
            'service_id' => $this->service->id,
            'name' => 'Size',
            'description' => 'Size of the service area',
            'is_required' => false,
            'sort_order' => 1,
        ]);

        ServiceParameterOption::create([
            'service_parameter_id' => $parameter->id,
            'option_value' => 'Small',
            'price_adjustment' => 0,
            'duration_minutes_adjustment' => 0,
        ]);

        ServiceParameterOption::create([
            'service_parameter_id' => $parameter->id,
            'option_value' => 'Large',
            'price_adjustment' => 10000,
            'duration_minutes_adjustment' => 30,
        ]);
    }

    public function test_service_booking_component_renders(): void
    {
        Livewire::test(ServiceBooking::class, ['service' => $this->service])
            ->assertStatus(200)
            ->assertSee($this->service->name);
    }

    public function test_can_create_appointment_with_valid_data(): void
    {
        $tomorrow = Carbon::tomorrow();
        $slotDateTime = $tomorrow->copy()->setTime(10, 0, 0);

        $component = Livewire::test(ServiceBooking::class, ['service' => $this->service])
            ->set('data.date', $tomorrow->toDateString())
            ->set('data.selectedSlot', $slotDateTime->toISOString());

        // Check initial state
        $this->assertDatabaseCount('appointments', 0);

        // Call create and capture any output
        try {
            $component->call('create');

            // Check if appointment was created
            $appointments = \App\Models\Appointment::all();
            $this->assertGreaterThan(0, $appointments->count(), 'No appointments were created. Total appointments: '.$appointments->count());

            // If we have appointments, verify the details
            if ($appointments->count() > 0) {
                $appointment = $appointments->first();
                $this->assertEquals($this->service->id, $appointment->service_id);
                $this->assertEquals('scheduled', $appointment->status);
            }

        } catch (\Exception $e) {
            $this->fail('Exception thrown during create: '.$e->getMessage());
        }
    }

    public function test_cannot_create_appointment_without_slot(): void
    {
        $tomorrow = Carbon::tomorrow();

        $component = Livewire::test(ServiceBooking::class, ['service' => $this->service])
            ->set('data.date', $tomorrow->toDateString())
            ->call('create');

        // Verify no appointment was created
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_cannot_create_appointment_with_past_slot(): void
    {
        $pastDateTime = Carbon::yesterday()->setTime(10, 0, 0);

        $component = Livewire::test(ServiceBooking::class, ['service' => $this->service])
            ->set('data.date', Carbon::yesterday()->toDateString())
            ->set('data.selectedSlot', $pastDateTime->toISOString())
            ->call('create');

        // Verify no appointment was created
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_pricing_updates_with_parameter_selection(): void
    {
        $parameter = $this->service->serviceParameters->first();
        $largeOption = $parameter->serviceParameterOptions->where('option_value', 'Large')->first();

        $component = Livewire::test(ServiceBooking::class, ['service' => $this->service]);

        // Initially should show base price
        $this->assertEquals(50000, $component->get('quote'));

        // Select the large option
        $component->set("data.selectedOptions.{$parameter->id}", $largeOption->id);

        // Should update the quote
        $this->assertEquals(60000, $component->get('quote')); // 50000 + 10000
    }
}
