<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KnowledgeResource;

class KnowledgeResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KnowledgeResource::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(3, true),
            'resource_type' => fake()->randomElement(["article","video","image","tutorial"]),
            'livestock_type' => fake()->randomElement(["cattle","goats","sheep","pigs","poultry"]),
            'disease_id' => fake()->word(),
            'is_featured' => fake()->boolean(),
            'created_by' => fake()->word(),
        ];
    }
}
