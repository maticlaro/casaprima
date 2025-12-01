<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // fake service category
            'name' => fake()->unique()->randomElement([
                'Electricidad',
                'Plomería',
                'Carpintería',
                'Pintura',
                'Albañilería',
                'Jardinería',
                'Limpieza del hogar',
                'Cerrajería',
                'Climatización (Aire acondicionado)',
                'Calefacción',
                'Reparación de electrodomésticos',
                'Pisos y azulejos',
                'Impermeabilización',
                'Techos y goteras',
                'Piscinas',
                'Mudanzas',
                'Domótica (hogar inteligente)',
                'Control de plagas',
                'Muebles y tapicería',
                'Vidriería y cristalería',
                'Cortinas y persianas',
            ]),
            'description' => fake()->text(),
            'icon' => fake()->word(),
            'slug' => fake()->slug(),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
            'meta_title' => fake()->word(),
            'meta_description' => fake()->word(),
            'meta_keywords' => fake()->word(),
            'og_title' => fake()->word(),
            'og_description' => fake()->word(),
            'og_image' => fake()->word(),
        ];
    }
}
