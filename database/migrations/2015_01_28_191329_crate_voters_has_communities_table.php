<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateVotersHasCommunitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voters_has_communities', function(Blueprint $table)
		{
			$table->integer('voter_id')->unsigned();
			$table->foreign('voter_id')->references('id')
				->on('voters')->onDelete('cascade');

			$table->integer('community_id')->unsigned();
			$table->foreign('community_id')->references('id')->on('communities');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voters_has_communities');
	}

}
