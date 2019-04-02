<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecursiveVotersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('voters', function(Blueprint $table)
		{
			$table->integer('superior')->unsigned()->nullable();
			$table->foreign('superior')->references('id')->on('voters');
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
			$table->dropForeign('voters_superior_foreign');
		});
	}

}
