<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppointmentRating::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'work_quality_rating' => fake()->numberBetween(-10000, 10000),
            'punctuality_rating' => fake()->numberBetween(-10000, 10000),
            'communication_rating' => fake()->numberBetween(-10000, 10000),
            'cleanliness_rating' => fake()->numberBetween(-10000, 10000),
            'value_rating' => fake()->numberBetween(-10000, 10000),
            'overall_rating' => fake()->numberBetween(-10000, 10000),
            'public_review' => fake()->text(),
            'private_feedback' => fake()->text(),
            'is_public' => fake()->boolean(),
            'helpful_votes_count' => fake()->numberBetween(-10000, 10000),
            'rating_reminder_sent_at' => fake()->dateTime(),
            'custom_responses' => '{}',
        ];
    }
}
