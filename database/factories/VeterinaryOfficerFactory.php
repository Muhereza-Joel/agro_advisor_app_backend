<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\VeterinaryOfficer;

class VeterinaryOfficerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VeterinaryOfficer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->word(),
            'qualification' => fake()->word(),
            'specialization' => fake()->word(),
            'subcounty_id' => fake()->word(),
            'license_number' => fake()->word(),
        ];
    }
}
