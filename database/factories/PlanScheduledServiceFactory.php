<?php

namespace Database\Factories;

use App\Models\MaintenancePlan;
use App\Models\PlanScheduledService;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanScheduledServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlanScheduledService::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'maintenance_plan_id' => MaintenancePlan::factory(),
            'service_id' => Service::factory(),
            'recommended_month' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->word(),
            'notes' => fake()->text(),
        ];
    }
}
