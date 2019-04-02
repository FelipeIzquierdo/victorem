<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateVotersHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voters_has_roles', function(Blueprint $table)
		{
			$table->integer('voter_id')->unsigned();
			$table->foreign('voter_id')->references('id')
				->on('voters')->onDelete('cascade');

			$table->integer('rol_id')->unsigned();
			$table->foreign('rol_id')->references('id')->on('roles');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voters_has_roles');
	}

}
