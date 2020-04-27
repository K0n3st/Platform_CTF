<?php

use Illuminate\Database\Seeder;

class CompetitionChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('challenge_competition')->insert([
        	'competition_id' => 1,
        	'challenge_id' => 1,
        	'points' => 50,
        ]);

        DB::table('challenge_competition')->insert([
            'competition_id' => 1,
            'challenge_id' => 2,
            'points' => 150,
        ]);

        DB::table('challenge_competition')->insert([
            'competition_id' => 1,
            'challenge_id' => 3,
            'points' => 100,
        ]);

        DB::table('challenge_competition')->insert([
            'competition_id' => 2,
            'challenge_id' => 4,
            'points' => 200,
        ]);

        DB::table('challenge_competition')->insert([
            'competition_id' => 1,
            'challenge_id' => 5,
            'points' => 350,
        ]);

    }
}
