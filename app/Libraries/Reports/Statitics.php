<?php namespace Victorem\Libraries\Reports;
	
use Victorem\Entities\PollingStation;
use Victorem\Entities\Location;

class Statitics
{
	public static function getVotersPerPollingStation($polling_station_ids)
	{
		$pollingStations = PollingStation::withVoters($polling_station_ids);
		
		$stat = [
			'content' => [
				['label' => 'Número de Votantes', 'data' => [] ],
				['label' => 'Potencial electoral', 'data' => [] ]
			],
			'names' => []
		];

		$count = 0;
		
		foreach ($pollingStations as $pollingStation) {
			array_push($stat['content'][0]['data'], [$count + 1, $pollingStation->voters->count()]);
			array_push($stat['content'][1]['data'], [$count + 2, $pollingStation->electoral_potential]);
			array_push($stat['names'], [$count + 2, $pollingStation->name]);
			$count += 3;
		}

		return $stat;
	}

	public static function getVotersPerLocations($locations_id)
	{
		$locations = Location::withVoters($locations_id);
		$stat = [
			'content' => [
				['label' => 'Número de Votantes', 'data' => [] ],
				['label' => 'Potencial electoral', 'data' => [] ]
			],
			'names' => []
		];

		$count = 0;
		foreach ($locations as $location) {
			array_push($stat['content'][0]['data'], [$count + 1, $location->voters->count()]);
			array_push($stat['content'][1]['data'], [$count + 2, $location->electoral_potential]);
			array_push($stat['names'], [$count + 2, $location->name]);
			$count += 3;
		}

		return $stat;
	}
}
?>