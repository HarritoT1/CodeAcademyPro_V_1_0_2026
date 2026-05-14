<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$this->truncateTables(['roles', 'users', 'password_reset_tokens', 'courses', 'topics', 'subtopics', 'registrations', 'user_topic_progresses', 'user_subtopic_progresses']);
        $this->truncateTables(['roles', 'users', 'password_reset_tokens', 'registrations', 'user_topic_progresses', 'user_subtopic_progresses']);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PasswordResetTokenSeeder::class);
        //$this->call(CourseSeeder::class);
        //$this->call(TopicSeeder::class);
        //$this->call(SubtopicSeeder::class);
        $this->call(RegistrationSeeder::class);
        $this->call(UserTopicProgressSeeder::class);
        $this->call(UserSubtopicProgressSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
