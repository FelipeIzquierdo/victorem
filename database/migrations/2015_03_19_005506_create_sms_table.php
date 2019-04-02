<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sms', function($table)
		{
    		$table->increments('id');           
    		$table->string('name', 100)->unique();
    		$table->string('select', 300);
    		$table->string('description', 200)->nullable();
    		$table->timestamps();

    		$table->string('url')->default('/')->nullable();
    		$table->string('image')->default('images/placeholders/icons/sms.png')->nullable();
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
		Schema::drop('sms');
	}

}
