<?php

use Illuminate\Database\Seeder;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'key' => 'headlineCompetition',
            'value' => '2',
        ]);

        DB::table('configs')->insert([
            'key' => 'LastWeekCompetition',
            'value' => '-1',
        ]);
    }
}
