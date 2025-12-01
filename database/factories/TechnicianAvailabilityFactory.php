<?php

namespace Database\Factories;

use App\Models\Technician;
use App\Models\TechnicianAvailability;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicianAvailabilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TechnicianAvailability::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'technician_id' => Technician::factory(),
            'start_datetime' => $start = fake()->dateTimeBetween('2025-01-01', '2025-12-31'),
            'end_datetime' => function (array $attributes) use (&$start) {
                $startCarbon = \Carbon\Carbon::instance($start);
                $end = (clone $startCarbon)->addDays(fake()->numberBetween(1, 100))->addHours(fake()->numberBetween(1, 8));

                return $end;
            },
        ];
    }
}
