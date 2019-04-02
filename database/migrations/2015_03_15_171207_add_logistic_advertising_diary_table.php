<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogisticAdvertisingDiaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('diary', function(Blueprint $table)
		{
			$table->text('logistic')->nullable();
			$table->text('advertising')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('diary', function(Blueprint $table)
		{
			$table->dropColumn(['logistic', 'advertising']);
		});
	}

}
