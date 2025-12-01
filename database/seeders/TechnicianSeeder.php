<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Technician;
use App\Models\TechnicianAvailability;
use Illuminate\Database\Seeder;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 4 technicians
        Technician::factory(4)->create()->each(function ($technician) {
            // For each technician, create 5 random availabilities
            TechnicianAvailability::factory(5)->create(['technician_id' => $technician->id]);
        });
        // Assign services to technicians
        Technician::all()->each(function ($technician) {
            $services = Service::inRandomOrder()
                ->take(rand(1, 5))
                ->pluck('id')
                ->toArray();
            $technician->services()->attach($services);
        });
    }
}
