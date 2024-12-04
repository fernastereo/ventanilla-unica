<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestType>
 */
class RequestTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true) . ' - ' . fake()->randomNumber(5, true),
            'description' => fake()->realText(60),
            'active' => fake()->randomElement([true, false]),
        ];
    }
}