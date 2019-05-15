<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule')->insert([
            'name' => 'Sábado'
        ]);

        DB::table('schedule_time')->insert([
            'time' => '09:30:00',
            'schedule_id' => 1,
        ]);

        DB::table('schedule_time')->insert([
            'time' => '13:30:00',
            'schedule_id' => 1,
        ]);

        DB::table('schedule_descriptions')->insert([
            'name' => 'Louvor',
            'schedule_time_id' => 1,
        ]);

        DB::table('schedule_descriptions')->insert([
            'name' => 'Mensagem Pastoral',
            'schedule_time_id' => 1,
        ]);

        DB::table('schedule_descriptions')->insert([
            'name' => 'Encerramento',
            'schedule_time_id' => 2,
        ]);
    }
}
