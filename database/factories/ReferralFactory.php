<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Referral;
use App\Models\Referred;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Referral::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'referrer_id' => Customer::factory(),
            'referred_id' => Referred::factory(),
            'code' => fake()->word(),
            'status' => fake()->randomElement(['active', 'used', 'expired']),
            'discount_amount' => fake()->randomFloat(2, 0, 99999999.99),
            'discount_type' => fake()->word(),
            'expires_at' => fake()->dateTime(),
            'used_at' => fake()->dateTime(),
            'customer_id' => Customer::factory(),
        ];
    }
}
