<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->word(),
            'title' => fake()->sentence(4),
            'message' => fake()->text(),
            'type' => fake()->randomElement(["alert","reminder","update"]),
            'related_type' => fake()->word(),
            'related_id' => fake()->randomNumber(),
            'is_read' => fake()->boolean(),
        ];
    }
}
