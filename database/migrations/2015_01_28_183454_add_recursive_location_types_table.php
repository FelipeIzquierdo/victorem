<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecursiveLocationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('location_types', function(Blueprint $table)
		{
			$table->integer('superior')->unsigned()->nullable();
			$table->foreign('superior')->references('id')->on('location_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('location_types', function(Blueprint $table)
		{
			$table->dropForeign('location_types_superior_foreign');
		});
	}

}
