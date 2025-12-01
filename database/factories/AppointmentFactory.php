<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Home;
use App\Models\HomeAsset;
use App\Models\PlanScheduledService;
use App\Models\Service;
use App\Models\Technician;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'service_id' => Service::factory(),
            'technician_id' => Technician::factory(),
            'plan_scheduled_service_id' => PlanScheduledService::factory(),
            'home_id' => Home::factory(),
            'home_asset_id' => HomeAsset::factory(),
            'scheduled_start_datetime' => fake()->dateTime(),
            'calculated_end_datetime' => fake()->dateTime(),
            'final_price' => fake()->randomFloat(2, 0, 99999999.99),
            'tax_amount' => fake()->randomFloat(2, 0, 99999999.99),
            'is_emergency' => fake()->boolean(),
            'status' => fake()->word(),
            'notes_for_technician' => fake()->text(),
            'customer_notes' => fake()->text(),
            'cancellation_reason' => fake()->text(),
            'payment_method' => fake()->word(),
            'payment_status' => fake()->word(),
            'is_rated' => fake()->boolean(),
        ];
    }
}
