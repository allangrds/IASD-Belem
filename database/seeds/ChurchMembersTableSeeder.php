<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChurchMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('church_members')->insert([
            'name' => 'João da Silva',
            'born_at' => new DateTime('2000-01-01') ,
        ]);

        DB::table('church_members')->insert([
            'name' => 'João da Silva 2',
            'born_at' => new DateTime('2000-01-02') ,
        ]);
    }
}
