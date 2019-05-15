<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('schedule_time_id')
                ->unsigned();

            $table->foreign('schedule_time_id')
                ->references('id')
                ->on('schedule_time')
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
        Schema::dropIfExists('schedule_descriptions');
    }
}
