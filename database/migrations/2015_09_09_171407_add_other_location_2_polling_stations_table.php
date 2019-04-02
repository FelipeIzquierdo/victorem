<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherLocation2PollingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polling_stations', function (Blueprint $table) 
        {
            $table->integer('location_id')->unsigned()->default(1);
            $table->foreign('location_id')->references('id')->on('locations');

            $table->string('description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('polling_stations', function (Blueprint $table) 
        {
            $table->dropColumn('description');

            $table->dropForeign('polling_stations_location_id_foreign');
            $table->dropIndex('polling_stations_location_id_foreign');

            $table->dropColumn('location_id');
        });
    }
}
