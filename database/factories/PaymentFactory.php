<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\MaintenancePlan;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'maintenance_plan_id' => MaintenancePlan::factory(),
            'amount' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'payment_method' => fake()->randomElement(['webpay', 'webpay_plus', 'webpay_oneclick', 'khipu', 'mach', 'mercadopago', 'bank_transfer', 'cash', 'check', 'debit_card', 'credit_card', 'pat']),
            'payment_platform' => fake()->randomElement(['transbank', 'khipu', 'mercadopago', 'manual']),
            'webpay_token' => fake()->word(),
            'webpay_session_id' => fake()->word(),
            'webpay_transaction_id' => fake()->word(),
            'webpay_card_type' => fake()->word(),
            'webpay_card_number' => fake()->word(),
            'webpay_auth_code' => fake()->word(),
            'webpay_response_code' => fake()->word(),
            'khipu_payment_id' => fake()->word(),
            'khipu_transfer_id' => fake()->word(),
            'khipu_bank_id' => fake()->word(),
            'khipu_bank_name' => fake()->word(),
            'bank_name' => fake()->word(),
            'bank_account_type' => fake()->word(),
            'bank_account_number' => fake()->word(),
            'bank_transfer_date' => fake()->date(),
            'bank_transfer_number' => fake()->word(),
            'pat_subscription_id' => fake()->word(),
            'pat_authorization_code' => fake()->word(),
            'pat_last_four' => fake()->word(),
            'mach_transaction_id' => fake()->word(),
            'document_type' => fake()->word(),
            'document_number' => fake()->word(),
            'tax_id' => fake()->word(),
            'business_name' => fake()->word(),
            'business_activity' => fake()->word(),
            'business_address' => fake()->word(),
            'notes' => fake()->text(),
            'paid_at' => fake()->dateTime(),
            'refunded_at' => fake()->dateTime(),
            'refund_reason' => fake()->text(),
            'internal_reference' => fake()->word(),
        ];
    }
}
