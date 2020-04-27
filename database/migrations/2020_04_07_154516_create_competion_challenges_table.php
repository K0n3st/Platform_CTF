<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetionChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_competition', function (Blueprint $table) {
            $table->integer('competition_id')->unsigned();
            $table->integer('challenge_id')->unsigned();
            $table->integer('points')->nullable();
            $table->boolean('visible')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('challenge_id')->references('id')->on('challenges');
            $table->primary(array('challenge_id','competition_id'));
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
        Schema::dropIfExists('competition_challenges');
    }
}
