<?php

namespace Database\Factories;

use App\Models\Funding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Funding>
 */
class FundingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Loan',
            'Mortgage',
            'Scholarship',
            'Grant',
        ]);

        $educationLevels = [
            'Undergraduate',
            'Graduate',
            'PhD',
            'Postdoctoral',
            'Masters',
            'All Levels',
        ];

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(4, true),
            'image' => 'https://images.unsplash.com/photo-1524995997946-a1…f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
            'education_level' => $this->faker->randomElement($educationLevels),
        ];
    }
}
