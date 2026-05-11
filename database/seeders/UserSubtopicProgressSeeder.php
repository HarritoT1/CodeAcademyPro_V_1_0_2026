<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSubtopicProgress;
use App\Models\User;

class UserSubtopicProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->inRandomOrder()->limit(8)->get();

        //Filtramos usuarios que si se encuentren inscritos en cursos.
        $users = $users->filter(function ($user) {
            return $user->courses->count() > 0;
        });

        foreach ($users as $user) {
            foreach ($user->courses as $course) {
                foreach ($course->topics as $topic) {
                    foreach ($topic->subtopics as $subtopic) {
                        UserSubtopicProgress::factory()->create([
                            'user_id' => $user->id,
                            'subtopic_id' => $subtopic->id,
                        ]);
                    }
                }
            }
        }
    }
}
