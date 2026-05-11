<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\User;
use App\Models\Course;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->inRandomOrder()->limit(10)->pluck('id')->toArray();
        $courses = Course::query()->inRandomOrder()->limit(5)->pluck('id')->toArray();

        foreach ($users as $userId) {
            foreach ($courses as $courseId) {
                Registration::factory()->create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                ]);
            }
        }
    }
}
