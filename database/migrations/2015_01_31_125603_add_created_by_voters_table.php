<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedByVotersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('voters', function(Blueprint $table) {
			$table->integer('created_by')->unsigned()->nullable();
		    $table->foreign('created_by')->references('id')->on('user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('voters', function(Blueprint $table) {
			$table->dropForeign('voters_created_by_foreign');
			$table->dropColumn('created_by');
		});
	}

}
