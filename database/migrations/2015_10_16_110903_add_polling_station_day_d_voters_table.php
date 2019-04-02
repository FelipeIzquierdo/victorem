<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPollingStationDayDVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voters', function (Blueprint $table) 
        {
            $table->integer('polling_station_day_d')->unsigned()->nullable();
            $table->foreign('polling_station_day_d')->references('id')->on('polling_stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voters', function (Blueprint $table) 
        {
            $table->dropForeign('voters_polling_station_day_d_foreign');
            $table->dropIndex('voters_polling_station_day_d_foreign');

            $table->dropColumn('polling_station_day_d');
        });
    }
}
