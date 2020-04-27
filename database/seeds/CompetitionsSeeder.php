<?php

use Illuminate\Database\Seeder;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            'name' => 'AlbertiCTF',
            'description' => 'supposed to be hidden',
            'enabled' => 0
        ]);

        DB::table('competitions')->insert([
            'name' => 'RootedConCTF',
            'description' => 'first ever RootedConCTF',
            'enabled' => 1
        ]);

        DB::table('competitions')->insert([
            'name' => 'AlbertiCTF#2',
            'description' => 'second AlbertiCTF',
            'enabled' => 1
        ]);
    }
}
