<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_time', function (Blueprint $table) {
            $table->increments('id');
            $table->time('time');
            $table->integer('schedule_id')
                ->unsigned();

            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedule')
                ->onDelete('cascade');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_time');
    }
}
