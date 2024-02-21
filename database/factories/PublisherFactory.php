<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => 'SP' . fake()->numerify('##'),
            'name' => fake()->name,
            'address' => fake()->address,
            'city' => fake()->city,
            'phone_number' => fake()->phoneNumber,
        ];
    }
}
