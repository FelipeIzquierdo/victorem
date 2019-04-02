<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOccupationVotersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('voters', function(Blueprint $table)
		{
			$table->text('description')->nullable();

			$table->integer('occupation')->unsigned()->nullable();
		    $table->foreign('occupation')->references('id')->on('occupations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('voters', function(Blueprint $table)
		{
			$table->dropForeign('voters_occupation_foreign');
			$table->dropColumn(['description', 'occupation']);
		});
	}

}
