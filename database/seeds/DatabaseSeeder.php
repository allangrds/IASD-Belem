<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ChurchMembersTableSeeder::class);
        $this->call(MemberFunctionSeeder::class);
        $this->call(ChurchDepartmentsTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
    }
}
