<?php

namespace Database\Factories;

use App\Models\Home;
use App\Models\HomeAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeAssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeAsset::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'home_id' => Home::factory(),
            'name' => fake()->name(),
            'asset_type' => fake()->word(),
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'serial_number' => fake()->word(),
            'installation_date' => fake()->date(),
            'notes' => fake()->text(),
        ];
    }
}
