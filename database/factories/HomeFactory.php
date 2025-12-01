<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Home;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Home::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'name' => fake()->name(),
            'address' => fake()->text(),
            'region' => fake()->word(),
            'comuna' => fake()->word(),
            'postal_code' => fake()->postcode(),
            'square_meters' => fake()->numberBetween(-10000, 10000),
            'condominium_name' => fake()->word(),
            'geo_location' => '{}',
            'is_primary' => fake()->boolean(),
            'access_instructions' => fake()->text(),
            'security_instructions' => fake()->text(),
        ];
    }
}
