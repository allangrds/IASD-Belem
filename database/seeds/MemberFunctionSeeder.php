<?php

use Illuminate\Database\Seeder;

class MemberFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('function')->insert([
            'name' => 'Pastor',
        ]);

        DB::table('function')->insert([
            'name' => 'Anciã',
        ]);

        DB::table('function')->insert([
            'name' => 'Ancião',
        ]);

        DB::table('function')->insert([
            'name' => 'Diaconisa',
        ]);

        DB::table('function')->insert([
            'name' => 'Diácono',
        ]);
    }
}
