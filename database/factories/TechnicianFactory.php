<?php

namespace Database\Factories;

use App\Models\Technician;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Technician::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            // RUT (Rol Único Tributario) is a Chilean tax identification number of 8 digits followed by a verification digit.
            'rut' => fake()->numberBetween(10000000, 99999999).'-'.fake()->randomElement(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']),
            'phone_number' => fake()->phoneNumber(),
            'is_active' => fake()->boolean(),
            'picture_url' => fake()->word(),
            'description' => fake()->text(),
        ];
    }
}
