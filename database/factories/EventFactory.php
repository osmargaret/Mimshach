<?php

namespace Database\Factories;

use App\Models\Event;
use Galahad\TimezoneMapper\Facades\TimezoneMapper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = require database_path('data/locations.php');
        $location = $this->faker->randomElement($locations);

        $latitude = $location['lat'];
        $longitude = $location['lng'];
        $timezone = TimezoneMapper::mapCoordinates($latitude, $longitude, 'UTC');

        $startDate = $this->faker->dateTimeBetween('now', '+6 months');
        $endDate = (clone $startDate)->modify('+2 hours');

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(5, true),
            'subtitle' => $this->faker->sentence(2),
            'image' => 'https://images.unsplash.com/photo-1524995997946-a1…f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
            'start_time' => $startDate,
            'end_time' => $endDate,
            'location' => $location['location'],
            'date' => $startDate->format('Y-m-d'),
            'timezone' => $timezone,
        ];
    }
}
