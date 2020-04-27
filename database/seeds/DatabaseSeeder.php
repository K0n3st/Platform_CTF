<?php

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
        $this->call(CompetitionsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ChallengesSeeder::class);
        $this->call(CompetitionChallengeSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ParticipationsSeeder::class);
        $this->call(ConfigsSeeder::class);
    }
}
