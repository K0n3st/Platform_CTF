<?php

use Illuminate\Database\Seeder;

class ChallengesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('challenges')->insert([
            'name' => 'The force',
            'description' => 'Please brute force this passwd file, use john if you want. Please solve this',
            'flag' => 'flag{the_flag}',
            'points' => 50,
            'author' => 'K0n3st',
            'category_id' => 6,
        ]);

        DB::table('challenges')->insert([
            'name' => 'base64docede',
            'description' => 'please decode this string use base64, I know you can do it',
            'flag' => 'flag{the_flag}',
            'points' => 50,
            'author' => 'K0n3st',
            'category_id' => 1,
        ]);

        DB::table('challenges')->insert([
            'name' => 'caesar cipher',
            'description' => 'cipher replace strings here, hint is the name of an ape',
            'flag' => 'flag{the_flag}',
            'points' => 50,
            'author' => 'K0n3st',
            'category_id' => 1,
        ]);

        DB::table('challenges')->insert([
            'name' => 'sqlInjection',
            'description' => 'can you login as admin',
            'flag' => 'flag{the_flag}',
            'points' => 50,
            'author' => 'K0n3st',
            'category_id' => 2,
       ]);

        DB::table('challenges')->insert([
            'name' => 'androidAPK',
            'description' => 'reverse android APK, apk can be extracted :v',
            'flag' => 'flag{the_flag}',
            'points' => 50,
            'author' => 'K0n3st',
            'category_id' => 4,
        ]);
    }
}
