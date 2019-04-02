<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherLocationPollingStationsTable extends Migration
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
            $table->dropForeign('polling_stations_location_id_foreign');
            $table->dropIndex('polling_stations_location_id_foreign');

            $table->renameColumn('location_id', 'registraduria_location_id');
            $table->foreign('registraduria_location_id')->references('id')->on('locations');
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
            $table->dropForeign('polling_stations_registraduria_location_id_foreign');
            $table->dropIndex('polling_stations_registraduria_location_id_foreign');

            $table->renameColumn('registraduria_location_id', 'location_id');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }
}
