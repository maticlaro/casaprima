<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ServiceCategory::factory(4)
            ->has(\App\Models\Service::factory()->count(3)) // 3 services per category
            ->create();

        // create random service parameter for each service
        \App\Models\Service::all()->each(function ($service) {
            \App\Models\ServiceParameter::factory(rand(1, 3))->create(['service_id' => $service->id]);
        });

        \App\Models\ServiceParameter::all()->each(function ($parameter) {
            \App\Models\ServiceParameterOption::factory(rand(2, 4))->create(['service_parameter_id' => $parameter->id]);
        });
    }
}
