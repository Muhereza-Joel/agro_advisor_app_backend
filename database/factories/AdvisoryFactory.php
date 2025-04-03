<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Advisory;

class AdvisoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advisory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'farmer_id' => fake()->word(),
            'vet_id' => fake()->word(),
            'question' => fake()->text(),
            'response' => fake()->text(),
            'status' => fake()->randomElement(["pending","responded"]),
            'related_disease_id' => fake()->word(),
        ];
    }
}
