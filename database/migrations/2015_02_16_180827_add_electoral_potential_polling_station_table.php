<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddElectoralPotentialPollingStationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('polling_stations', function(Blueprint $table) {
			$table->integer('electoral_potential')->default(0)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('polling_stations', function(Blueprint $table) {
			$table->dropColumn('electoral_potential');
		});
	}

}
