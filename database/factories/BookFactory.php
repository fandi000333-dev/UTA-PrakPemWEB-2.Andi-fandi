<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
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
            'title' => ucwords(fake()->words(3, true)),
            'isbn' => fake()->unique()->numerify('978##########'),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'published_year' => fake()->numberBetween(2000, (int) date('Y')),
            'price' => fake()->randomFloat(2, 50_000, 500_000),
            'stock' => fake()->numberBetween(0, 50),
            'description' => fake()->optional(0.85)->paragraph(),
        ];
    }

}
