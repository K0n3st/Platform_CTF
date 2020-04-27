<?php

use Illuminate\Database\Seeder;

class ParticipationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participations')->insert([
            'user_id' => 1,
            'competition_id' => 1,
        ]);
        DB::table('participations')->insert([
            'user_id' => 2,
            'competition_id' => 1,
        ]);
        DB::table('participations')->insert([
            'user_id' => 3,
            'competition_id' => 1,
        ]);
        DB::table('participations')->insert([
            'user_id' => 1,
            'competition_id' => 2,
        ]);
        DB::table('participations')->insert([
            'user_id' => 5,
            'competition_id' => 2,
        ]);
    }
}
