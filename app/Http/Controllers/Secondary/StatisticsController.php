<?php namespace Victorem\Http\Controllers\Secondary;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Victorem\Libraries\Reports\Report;
use Victorem\Libraries\Reports\Statitics;
use Victorem\Libraries\Campaing;

use Victorem\Entities\PollingStation;
use Victorem\Entities\Location;
use Victorem\Entities\Voter;

class StatisticsController extends Controller {

	function __construct() {
		$this->middleware('logs');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('dashboard.pages.statistics.lists');
	}

	public function getBars()
	{
		$stat = Report::getAllGraphic()->find($request->get('report_id'));
		$url_json = $stat->getRouteJson($select_ids);

		return view('dashboard.pages.statistics.bars', compact('url_json', 'stat'));
	}

	public function getVotersOfPollingStations(Request $request)
	{
		$number_voters 			= Voter::numberVoters();
		$polling_station_ids 	= $request->get('polling_stations');
		$pollingStations 		= PollingStation::withVoters($polling_station_ids);

		$statistic_rol_names	= Campaing::getStatisticRolNames();
		$statistic_rol_ids		= Campaing::getStatisticRolIds();

		return view('dashboard.pages.statistics.polling_stations', compact(
			'pollingStations', 'number_voters', 'statistic_rol_names','statistic_rol_ids'
		));
	}

	public function getVotersOfPollingStationsDayD(Request $request)
	{
		$number_voters_day_d 	= Voter::numberVoters();
		$polling_station_ids 	= $request->get('polling_stations');
		$pollingStations 		= PollingStation::withVotersDayD($polling_station_ids);

		$statistic_rol_names	= Campaing::getStatisticRolNames();
		$statistic_rol_ids		= Campaing::getStatisticRolIds();

		return view('dashboard.pages.statistics.polling_stations_day_d', compact(
			'pollingStations', 'number_voters_day_d', 'statistic_rol_names','statistic_rol_ids'
		));
	}

	public function getVotersOfLocations(Request $request)
	{
		$number_voters 	= Voter::numberVoters();
		$type_ids = $request->get('location_types');
		$locations = Location::withVoters(null, $type_ids);

		return view('dashboard.pages.statistics.locations', compact('locations', 'number_voters'));
	}

}
