<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraph(8, true),
            'subtitle' => $this->faker->sentence(2),
            'featured_image' => 'https://images.unsplash.com/photo-1524995997946-a1…f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
        ];
    }
}
