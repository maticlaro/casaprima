<?php

namespace Database\Factories;

use App\Models\AppointmentRating;
use App\Models\Customer;
use App\Models\Rating;
use App\Models\RatingVote;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RatingVote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'rating_id' => Rating::factory(),
            'customer_id' => Customer::factory(),
            'is_helpful' => fake()->boolean(),
            'appointment_rating_id' => AppointmentRating::factory(),
        ];
    }
}
