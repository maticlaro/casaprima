<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Referral;
use App\Models\ReferralReward;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralRewardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReferralReward::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'referral_id' => Referral::factory(),
            'beneficiary_id' => Customer::factory(),
            'amount' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->word(),
            'appointment_id' => Appointment::factory(),
            'paid_at' => fake()->dateTime(),
            'customer_id' => Customer::factory(),
        ];
    }
}
