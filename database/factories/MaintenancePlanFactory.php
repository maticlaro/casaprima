<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\MaintenancePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenancePlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaintenancePlan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'year' => fake()->year(),
            'status' => fake()->word(),
        ];
    }
}
