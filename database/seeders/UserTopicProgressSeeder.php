<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserTopicProgress;
use App\Models\User;

class UserTopicProgressSeeder extends Seeder
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
            $usercourses = $user->courses;
            foreach ($usercourses as $course) {
                $topics = $course->topics;
                foreach ($topics as $topic) {
                    UserTopicProgress::factory()->create([
                        'user_id' => $user->id,
                        'topic_id' => $topic->id,
                    ]);
                }
            }
        }
    }
}
