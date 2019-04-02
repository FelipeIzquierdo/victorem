<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('doc')->unique();
			$table->string('name');

			$table->string('telephone')->nullable();
			$table->string('address')->nullable();
			$table->string('email')->nullable();
			$table->char('sex', 1);
			$table->date('date_of_birth')->nullable();
			$table->integer('table_number')->nullable()->default(0);

			$table->timestamps();

			$table->integer('location_id')->unsigned();
			$table->foreign('location_id')->references('id')->on('locations');

			$table->integer('polling_station_id')->unsigned()->nullable();
			$table->foreign('polling_station_id')->references('id')->on('polling_stations');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voters');
	}

}
