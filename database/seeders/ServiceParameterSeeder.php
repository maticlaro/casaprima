<?php

namespace Database\Seeders;

use App\Models\ServiceParameter;
use Illuminate\Database\Seeder;

class ServiceParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            ['service_id' => 1, 'name' => 'Área del Jardín'],

        ];

        foreach ($parameters as $parameter) {
            ServiceParameter::create($parameter);
        }
    }
}
