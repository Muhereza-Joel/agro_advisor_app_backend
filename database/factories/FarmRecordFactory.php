<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FarmRecord;

class FarmRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FarmRecord::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'farmer_id' => fake()->word(),
            'record_type' => fake()->randomElement(["vaccination","breeding","feeding","health","financial"]),
            'details' => fake()->text(),
            'date' => fake()->date(),
            'related_disease_id' => fake()->word(),
        ];
    }
}
