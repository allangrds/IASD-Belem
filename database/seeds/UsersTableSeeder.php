<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'normal',
            'email' => 'normal@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
