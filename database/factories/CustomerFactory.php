<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'rut' => fake()->word(),
            'phone_number' => fake()->phoneNumber(),
            'notification_preferences' => '{}',
            'preferred_contact_method' => fake()->word(),
            'authorized_representative' => fake()->word(),
            'billing_data' => '{}',
        ];
    }
}
