<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_category_id' => ServiceCategory::factory(),
            'name' => fake()->unique()->randomElement([
                'Limpieza de hogar',
                'Reparación de electrodomésticos',
                'Fontanería',
                'Electricidad',
                'Pintura de interiores',
                'Jardinería',
                'Instalación de aire acondicionado',
                'Mudanza',
                'Mantenimiento de piscina',
                'Cuidado de mascotas',
                'Cerrajería',
                'Fumigación',
                'Instalación de cortinas',
                'Reparación de techos',
                'Limpieza de alfombras',
                'Servicio de lavandería',
                'Instalación de pisos',
                'Reparación de ventanas',
                'Montaje de muebles',
                'Servicio de niñera',
                'Reparación de bicicletas',
                'Desinfección',
                'Limpieza de fachadas',
            ]),
            'short_description' => fake()->text(fake()->numberBetween(80, 100)),
            'long_description' => fake()->text(),
            'icon' => fake()->word(),
            // Random integer between 50000 and 250000 with 50000 jumps
            'base_price' => fake()->randomElement(range(50000, 250000, 50000)),
            'base_duration_minutes' => fake()->randomElement(range(60, 300, 60)),
            'is_emergency_available' => fake()->boolean(),
            'emergency_surcharge' => fake()->randomFloat(2, 0, 99999999.99),
            'slug' => fake()->slug(),
            'is_active' => $isActive = fake()->boolean(),
            'home_featured' => $isActive ? true : fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
            'travel_fee_per_km' => fake()->randomFloat(2, 0, 99999999.99),
            'requires_site_inspection' => fake()->boolean(),
            'satisfaction_survey_template' => '{}',
            'meta_title' => fake()->word(),
            'meta_description' => fake()->word(),
            'meta_keywords' => fake()->word(),
            'og_title' => fake()->word(),
            'og_description' => fake()->word(),
            'og_image' => fake()->word(),
            'schema_markup' => '{}',
            'protocol_url' => fake()->word(),
        ];
    }
}
