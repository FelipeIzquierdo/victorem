<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoterPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_polls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observation')->nullable();
            $table->enum('result', ['answer', 'not_answer', 'off', 'unrealized', 'dont_work'])->default('unrealized');
            $table->timestamps();

            $table->integer('poll_id')->unsigned();
            $table->foreign('poll_id')->references('id')->on('polls');

            $table->integer('voter_id')->unsigned();
            $table->foreign('voter_id')->references('id')->on('voters');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('voter_polls');
    }
}
