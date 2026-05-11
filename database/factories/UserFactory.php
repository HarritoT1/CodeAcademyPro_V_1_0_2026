<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => fake()->optional(0.5)->name(),
            'name' => fake()->unique()->userName(),
            'password' => Hash::make('password'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => fake()->optional(0.5)->dateTime(),
            'is_active' => fake()->boolean(80),
            'phone_number' => fake()->optional(0.5)->bothify('##-####-####'),
            'home_address' => fake()->optional(0.5)->address(),
            'description' => fake()->optional(0.5)->sentence(10),
            'avatar_url' => "UploadFiles/default-avatar.png",
            'remember_token' => Str::random(10),

            'rol_id' => Role::query()->inRandomOrder()->value('id'),
            'google_id' => fake()->optional(0.5)->uuid(),
        ];
    }
}
