<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DiseaseReport;

class DiseaseReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiseaseReport::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'farmer_id' => fake()->word(),
            'vet_id' => fake()->word(),
            'disease_id' => fake()->word(),
            'livestock_type' => fake()->randomElement(["cattle","goats","sheep","pigs","poultry"]),
            'symptoms' => '{}',
            'status' => fake()->randomElement(["pending","diagnosed","treated","resolved"]),
            'diagnosis' => fake()->text(),
            'treatment' => fake()->text(),
            'severity' => fake()->randomElement(["low","medium","high","critical"]),
            'village_id' => fake()->word(),
            'suggested_diseases' => '{}',
        ];
    }
}
