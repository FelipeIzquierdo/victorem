<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesHasModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_types_has_modules', function(Blueprint $table)
		{
			$table->integer('user_type_id')->unsigned();
			$table->foreign('user_type_id')->references('id')
				->on('user_types')->onDelete('cascade');

			$table->integer('module_id')->unsigned();
			$table->foreign('module_id')->references('id')
				->on('modules')->onDelete('cascade');

			$table->primary(['user_type_id', 'module_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_types_has_modules');
	}

}
