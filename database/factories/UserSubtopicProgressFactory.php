<?php

namespace Database\Factories;

use App\Models\UserSubtopicProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserSubtopicProgress>
 */
class UserSubtopicProgressFactory extends Factory
{
    protected $model = UserSubtopicProgress::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // Cambiarlo en el seeder.
            'subtopic_id' => 1, // Cambiarlo en el seeder.
        ];
    }
}
