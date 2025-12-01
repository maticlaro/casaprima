<?php

namespace Database\Seeders;

use App\Enums\MeasurementUnit;
use App\Models\ServiceParameterOption;
use Illuminate\Database\Seeder;

class ServiceParameterOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['service_parameter_id' => 1,
                'option_value' => '0 - 50',
                'price_adjustment' => 0,
                'duration_minutes_adjustment' => 0,
                'measurement_unit' => MeasurementUnit::M2->value, ],

            ['service_parameter_id' => 1,
                'option_value' => '50 - 150',
                'price_adjustment' => 5000,
                'duration_minutes_adjustment' => 30,
                'measurement_unit' => MeasurementUnit::M2->value],

            ['service_parameter_id' => 1,
                'option_value' => '150 - 300',
                'price_adjustment' => 15000,
                'duration_minutes_adjustment' => 60,
                'measurement_unit' => MeasurementUnit::M2->value],
        ];

        foreach ($options as $option) {
            ServiceParameterOption::create($option);
        }
    }
}
