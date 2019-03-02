<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFunctionToChurchMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('church_members', function (Blueprint $table) {
            $table->integer('function_id')
                ->unsigned()
                ->nullable();

            $table->foreign('function_id')
                ->references('id')
                ->on('function')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('church_members', function (Blueprint $table) {
            $table->dropForeign(['function_id']);
            $table->dropColumn('function_id');
        });
    }
}
