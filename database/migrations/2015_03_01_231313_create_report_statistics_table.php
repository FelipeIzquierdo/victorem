<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_statistics', function($table)
		{
    		$table->increments('id');           
    		$table->string('name', 100)->unique();
    		$table->string('select', 100);
    		$table->string('description', 200)->nullable();
    		$table->string('message', 200)->nullable();
    		$table->timestamps();

    		$table->string('url')->default('/')->nullable();
    		$table->string('image')->default('images/placeholders/icons/user.png')->nullable();
    		$table->enum('type', ['report', 'statistics',])->default('report')->nullable();
    		$table->enum('option', ['select', 'simple',])->default('select')->nullable();
    		$table->boolean('active')->default(true)->nullable();    
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('report_statistics');
	}

}
