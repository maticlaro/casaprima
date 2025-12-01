<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Mantenimiento de Jardín', 'service_category_id' => 3,
                'base_price' => 40000, 'base_duration_minutes' => 90, 'is_active' => true,
                'short_description' => 'Servicio de mantenimiento de jardines',
                'slug' => 'mantenimiento-de-jardin'],

        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
