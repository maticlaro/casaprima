<?php

namespace Database\Factories;

use App\Models\ParameterOption;
use App\Models\ServiceParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParameterOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParameterOption::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_parameter_id' => ServiceParameter::factory(),
            'option_value' => fake()->word(),
            'price_adjustment' => fake()->randomFloat(2, 0, 99999999.99),
            'duration_minutes_adjustment' => fake()->numberBetween(-10000, 10000),
            'measurement_unit' => fake()->randomElement(['kg', "m\u00b2", "m\u00b3"]),
        ];
    }
}
