<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsedHintsTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_hint_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->integer('hints_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->integer('challenge_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('hints_id')->references('id')->on('hints');
            $table->foreign('competition_id')->references('id')->on('competitions');
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
        Schema::dropIfExists('used_hint_teams');
    }
}
