<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryVoterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_voter', function (Blueprint $table) {
            $table->integer('diary_id')->unsigned();
            $table->foreign('diary_id')->references('id')->on('diary');

            $table->integer('voter_id')->unsigned();
            $table->foreign('voter_id')->references('id')->on('voters');

            $table->primary(['diary_id', 'voter_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diary_voter');
    }
}
