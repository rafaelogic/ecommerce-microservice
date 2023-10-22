<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->safeColorName(),
            'description' => fake()->sentences(asText:True),
            'price' => fake()->randomFloat(
                min: 1,
                max: 100,
                nbMaxDecimals: 2
            )
        ];
    }
}
