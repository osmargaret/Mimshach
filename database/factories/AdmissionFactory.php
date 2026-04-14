<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Admission>
 */
class AdmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $programs = [
            'Computer Science',
            'Business Administration',
            'Medicine',
            'Law',
            'Engineering',
            'Data Science',
            'Public Health',
        ];

        $titles = [
            'Fall Admission',
            'Spring Intake',
            'Summer Session',
            'Scholarship Opportunity',
            'Early Admission',
            'Regular Decision',
        ];

        // Generate admission year (the year the program starts)
        $admissionYear = $this->faker->numberBetween(2025, 2028);

        // Generate deadline: a date before the admission year starts (between 6 months to 1 year before)
        $deadlineStart = Carbon::create($admissionYear - 1, 7, 1); // July of previous year
        $deadlineEnd = Carbon::create($admissionYear, 1, 1)->subDay(); // Just before admission year starts
        $deadline = $this->faker->dateTimeBetween($deadlineStart, $deadlineEnd);

        return [
            'title' => $this->faker->randomElement($titles).' '.$admissionYear,
            'subtitle' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'https://images.unsplash.com/photo-1524995997946-a1…f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
            'program' => $this->faker->randomElement($programs),
            'year' => $admissionYear,
            'deadline' => $deadline,
            'university_id' => University::factory(),
            'country' => $this->faker->country(),
        ];
    }
}
