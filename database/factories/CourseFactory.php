<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_name' => fake()->unique()->sentence(6),
            'image_url' => fake()->unique()->imageUrl(rand(200, 400), rand(100, 400), 'Course', true),
            'description' => fake()->paragraph(4),
            'programming_language' => fake()->randomElement(['PHP', 'JavaScript', 'Python', 'Java', 'C#', 'Ruby', 'Go', 'Swift']),
            'duration' => $this->faker->randomFloat(1, 1, 150), // Duration in hours.
            'is_visible' => fake()->boolean(80),
        ];
    }
}
