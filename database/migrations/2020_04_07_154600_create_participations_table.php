<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->integer('points')->default(0);
            $table->dateTime('latest_submit')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDELETE('CASCADE')->onUPDATE('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participations');
    }
}
