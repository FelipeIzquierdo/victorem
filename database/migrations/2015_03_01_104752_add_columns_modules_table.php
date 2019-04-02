<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('modules', function(Blueprint $table)
		{
			$table->string('url')->default('/')->nullable();
			$table->string('image')->default('images/placeholders/icons/user.png')->nullable();
			$table->string('color_class')->default('themed-background')->nullable();
			$table->string('icon_class')->default('gi gi-group')->nullable();

			$table->enum('type', ['main', 'extra', 'system'])->default('main')->nullable();
			$table->boolean('active')->default(true)->nullable();

			$table->integer('superior')->unsigned()->nullable();
		    $table->foreign('superior')->references('id')->on('modules');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('modules', function(Blueprint $table)
		{
			$table->dropForeign('modules_superior_foreign');
			$table->dropColumn(['url', 'image', 'type', 'active', 'superior', 'icon_class', 'color_class']);
		});
	}

}
