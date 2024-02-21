<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => 'K' . fake()->numerify('###'),
            'publisher_id' => rand(1,3),
            'name' => fake()->word,
            'category' => fake()->randomElement(['Keilmuan', 'Novel', 'Bisnis']),
            'price' => fake()->numerify('#####'),
            'stocks' => fake()->numerify('##'),
        ];
    }
}
