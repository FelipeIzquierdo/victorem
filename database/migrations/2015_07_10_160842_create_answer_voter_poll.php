<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerVoterPoll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_voter_poll', function (Blueprint $table) {
            $table->integer('voter_poll_id')->unsigned();
            $table->foreign('voter_poll_id')->references('id')->on('voter_polls');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_voter_poll');
    }
}
