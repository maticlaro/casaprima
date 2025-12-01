<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Warranty;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarrantyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warranty::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'appointment_id' => Appointment::factory(),
            'duration_months' => fake()->numberBetween(-10000, 10000),
            'starts_at' => fake()->dateTime(),
            'expires_at' => fake()->dateTime(),
            'terms' => fake()->text(),
            'status' => fake()->word(),
            'void_reason' => fake()->text(),
            'notification_sent' => fake()->boolean(),
        ];
    }
}
