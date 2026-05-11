<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PasswordResetToken;
use App\Models\User;

class PasswordResetTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Choose five random users to create unique password reset tokens. 
        $users = User::query()->inRandomOrder()->limit(5)->pluck('id')->toArray();

        foreach ($users as $userId) {
            PasswordResetToken::factory()->create([
                'user_id' => $userId,
            ]);
        }
    }
}
