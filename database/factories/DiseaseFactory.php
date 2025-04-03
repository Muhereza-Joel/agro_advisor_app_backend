<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Disease;

class DiseaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Disease::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category_id' => fake()->word(),
            'livestock_type' => fake()->randomElement(["cattle","goats","sheep","pigs","poultry"]),
            'symptoms' => fake()->text(),
            'prevention' => fake()->text(),
            'treatment' => fake()->text(),
            'is_zoonotic' => fake()->boolean(),
            'key_symptoms' => '{}',
            'secondary_symptoms' => '{}',
        ];
    }
}
