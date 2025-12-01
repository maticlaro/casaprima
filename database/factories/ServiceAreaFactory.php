<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceArea::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'region' => fake()->word(),
            'comuna' => fake()->word(),
            'is_available' => fake()->boolean(),
            'min_price' => fake()->randomFloat(2, 0, 99999999.99),
            'travel_fee' => fake()->randomFloat(2, 0, 99999999.99),
            'minimum_notice_hours' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
