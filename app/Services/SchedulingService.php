<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceParameterOption;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SchedulingService
{
    public function getSlotsForDay(Service $service, Carbon $day, Collection $selectedOptionIds): array
    {
        $tz = config('company.timezone', 'America/Santiago');
        $day = $day->clone()->setTimezone($tz);

        $interval = (int) config('company.slot_interval_minutes', 30);
        $buffer = (int) config('company.per_appointment_buffer_minutes', 15);

        $weekday = (int) $day->isoWeekday(); // 1..7
        $hours = config("company.business_hours.$weekday");
        if (! $hours) {
            return [];
        }

        $open = Carbon::parse($day->toDateString().' '.$hours['start'], $tz);
        $close = Carbon::parse($day->toDateString().' '.$hours['end'], $tz);

        // duration = base + adjustments + buffer
        $duration = (int) $service->base_duration_minutes + (int) ServiceParameterOption::whereIn('id', $selectedOptionIds)->sum('duration_minutes_adjustment') + $buffer;

        $slots = [];
        for ($start = $open->clone(); $start->lt($close); $start->addMinutes($interval)) {
            $end = $start->clone()->addMinutes($duration);
            if ($end->gt($close)) {
                break;
            }
            if ($this->hasAvailableTechnician($service, $start, $end)) {
                $slots[] = [
                    'start' => $start->copy(),
                    'end' => $end->copy(),
                ];
            }
        }

        return $slots;
    }

    protected function hasAvailableTechnician(Service $service, Carbon $start, Carbon $end): bool
    {
        // tech offers service and has availability that fully covers the slot and no overlapping appointments.
        return Technician::whereHas('services', fn ($q) => $q->where('services.id', $service->id))
            ->where('is_active', true)
            ->whereHas('technicianAvailabilities', function ($q) use ($start, $end) {
                $q->where('start_datetime', '<=', $start)
                    ->where('end_datetime', '>=', $end);
            })
            ->whereDoesntHave('appointments', function ($q) use ($start, $end) {
                $q->where(function ($qq) use ($start, $end) {
                    $qq->whereBetween('scheduled_start_datetime', [$start, $end])
                        ->orWhereBetween('calculated_end_datetime', [$start, $end])
                        ->orWhere(function ($qqq) use ($start, $end) {
                            $qqq->where('scheduled_start_datetime', '<=', $start)
                                ->where('calculated_end_datetime', '>=', $end);
                        });
                });
            })
            ->exists();
    }

    public function findAvailableTechnicianForSlot(Service $service, Carbon $start, Carbon $end): ?Technician
    {
        // Find the first available technician for this slot
        return Technician::whereHas('services', fn ($q) => $q->where('services.id', $service->id))
            ->where('is_active', true)
            ->whereHas('technicianAvailabilities', function ($q) use ($start, $end) {
                $q->where('start_datetime', '<=', $start)
                    ->where('end_datetime', '>=', $end);
            })
            ->whereDoesntHave('appointments', function ($q) use ($start, $end) {
                $q->where(function ($qq) use ($start, $end) {
                    $qq->whereBetween('scheduled_start_datetime', [$start, $end])
                        ->orWhereBetween('calculated_end_datetime', [$start, $end])
                        ->orWhere(function ($qqq) use ($start, $end) {
                            $qqq->where('scheduled_start_datetime', '<=', $start)
                                ->where('calculated_end_datetime', '>=', $end);
                        });
                });
            })
            ->first();
    }
}
