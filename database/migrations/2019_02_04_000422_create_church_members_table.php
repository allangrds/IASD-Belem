<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChurchMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 35);
            $table->string('email', 50)->nullable();
            $table->string('telephone', 14)->nullable();
            $table->date('born_at');
            $table->string('image', 255)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('church_members');
    }
}
