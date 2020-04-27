<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Cryptography',
            'description' => 'crypting language, encoding and decoding',
        ]);

        DB::table('categories')->insert([
            'name' => 'Web Hacking',
            'description' => 'assessing vurnerabilities in web and exploit them',
        ]);

        DB::table('categories')->insert([
            'name' => 'Forensic',
            'description' => 'see what they left behind',
        ]);

        DB::table('categories')->insert([
            'name' => 'Reverse Engineering',
            'description' => 'reverse things, undo or redo',
        ]);

        DB::table('categories')->insert([
            'name' => 'Exploitation',
            'description' => 'pwn before your enemies pwn',
        ]);

        DB::table('categories')->insert([
            'name' => 'Miscellaneous',
            'description' => 'trivial things matter',
        ]);
    }
}
