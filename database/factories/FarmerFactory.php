<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Farmer;

class FarmerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Farmer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->word(),
            'farm_name' => fake()->word(),
            'livestock_type' => fake()->randomElement(["cattle","goats","sheep","pigs","poultry"]),
            'livestock_count' => fake()->numberBetween(-10000, 10000),
            'village_id' => fake()->word(),
            'coordinates' => fake()->word(),
        ];
    }
}
