<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('done_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time');
            $table->integer('participation_team_id')->unsigned();
            $table->integer('challenge_id')->unsigned();
            $table->string('flag');
            $table->integer('status');
            $table->foreign('participation_team_id')->references('id')->on('participation_teams');
            $table->foreign('challenge_id')->references('id')->on('challenges');
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
        Schema::dropIfExists('done_teams');
    }
}
