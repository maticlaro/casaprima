<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentLog;
use App\Models\Technician;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppointmentLog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'technician_id' => Technician::factory(),
            'log_type' => fake()->randomElement(['text_note', 'before_photo', 'after_photo', 'document']),
            'content_url' => fake()->word(),
            'notes' => fake()->text(),
        ];
    }
}
