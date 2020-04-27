<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 0; $i < 5; $i++):

            DB::table('users')->insert([
                'username' => 'user' . $i,
                'name' => str_random(8),
                'surname' => str_random(8),
                'email' => 'user' . $i .'@mail.com',
                'password' => bcrypt('secret'),
                'type' => 0
            ]);
    
            endfor;
    
            DB::table('users')->insert([
                'username' => 'admin',
                'name' => 'administrator',
                'surname' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'type' => 1
            ]);
    }
}
