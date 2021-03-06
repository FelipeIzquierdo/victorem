<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->enum('type', ['unic', 'multiple']);
            $table->timestamps();

            $table->integer('poll_id')->unsigned();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');;

            $table->unique(['poll_id', 'text']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
