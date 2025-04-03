<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OutbreakAlert;

class OutbreakAlertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OutbreakAlert::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'disease_id' => fake()->word(),
            'subcounty_id' => fake()->word(),
            'severity' => fake()->randomElement(["low","medium","high","critical"]),
            'description' => fake()->text(),
            'recommendations' => fake()->text(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'created_by' => fake()->word(),
        ];
    }
}
