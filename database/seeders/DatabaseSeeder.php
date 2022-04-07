<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            SubAdminSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            ExamSeeder::class,
            QuestionSeeder::class,
            RevisionSeeder::class,
            TrainerSeeder::class,
        ]);
    }
}
