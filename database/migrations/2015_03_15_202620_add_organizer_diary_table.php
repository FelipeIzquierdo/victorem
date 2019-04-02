<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganizerDiaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('diary', function(Blueprint $table)
		{
			$table->integer('organizer_id')->unsigned()->nullable();
        	$table->foreign('organizer_id')->references('id')->on('voters');
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
			$table->dropForeign('diary_organizer_id_foreign');
			$table->dropColumn('organizer_id');	
		});
	}

}
