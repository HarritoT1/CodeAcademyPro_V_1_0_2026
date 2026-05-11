<?php

namespace Database\Factories;

use App\Models\PasswordResetToken;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PasswordResetToken>
 */
class PasswordResetTokenFactory extends Factory
{
    protected $model = PasswordResetToken::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, //Cambiar en seeder.
            'code_hash' => $this->faker->sha256(),
            'attempts' => $this->faker->numberBetween(0, 3),
            'expires_at' => now()->addMinutes(rand(1, 10)),
        ];
    }
}
