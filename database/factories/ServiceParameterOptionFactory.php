<?php

namespace Database\Factories;

use App\Models\ServiceParameter;
use App\Models\ServiceParameterOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceParameterOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceParameterOption::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_parameter_id' => ServiceParameter::factory(),
            'option_value' => fake()->randomElement([
                '0 - 50',
                '50 - 100',
                '100 - 150',
                '150 - 200',

            ]),
            'price_adjustment' => fake()->randomElement(['10000', '20000', '40000', '50000']),
            'duration_minutes_adjustment' => fake()->randomElement(['60', '120', '240', '300']),
            'measurement_unit' => fake()->randomElement(\App\Enums\MeasurementUnit::cases())->value,
        ];
    }
}
