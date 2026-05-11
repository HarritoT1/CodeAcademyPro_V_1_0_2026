<?php

namespace Database\Factories;

use App\Models\UserTopicProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserTopicProgress>
 */
class UserTopicProgressFactory extends Factory
{
    protected $model = UserTopicProgress::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // Cambiarlo en el seeder.
            'topic_id' => 1, // Cambiarlo en el seeder.
        ];
    }
}
