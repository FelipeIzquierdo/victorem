<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diary', function($table)			
        {
        	$table->increments('id'); 
        	$table->string('name', 100);
        	$table->integer('location_id')->unsigned();
			$table->foreign('location_id')->references('id')->on('locations');
        	$table->string('place', 200);
        	$table->string('description', 200)->nullable();
        	$table->date('date');
        	$table->time('time');
        	$table->time('endtime');
        	$table->boolean('hasdelegate')->default(false)->nullable();
        	$table->integer('delegate_id')->unsigned();
        	$table->foreign('delegate_id')->references('id')->on('voters');
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
		Schema::drop('diary');
	}

}
