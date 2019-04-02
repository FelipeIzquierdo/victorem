<?php namespace Victorem\Http\Controllers\Secondary;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Victorem\Libraries\Reports\ReportsUtilities;
use Victorem\Libraries\Reports\Report;

class ReportsController extends Controller {

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
		$reports = Report::getAllPlainActive();
		
		return view('dashboard.pages.reports.lists', compact('reports'));
	}

	public function getPeople(Request $request)
	{
		$sex = $request->get('select');
		$pdf = ReportsUtilities::getPeople($sex);
		$pdf->Output();

		return exit;
	}

	public function getUsers(Request $request)
	{
		$pdf = ReportsUtilities::getUsers();
		$pdf->Output();

		return exit;
	}

	public function getVoterPolls(Request $request, $poll_id = null)
	{
		$pdf = ReportsUtilities::getVoterPolls($poll_id);
		$pdf->Output();

		return exit;
	}

	public function getDelegates(Request $request)
	{
		$pdf = ReportsUtilities::getDelegates();
		$pdf->Output();

		return exit;
	}

	public function getPeopleWithBirthdayCurrentMonth(Request $request)
	{
		$pdf = ReportsUtilities::getPeopleWithBirthdayCurrentMonth();
		$pdf->Output();

		return exit;
	}

	public function getPeopleWithoutPollingStation(Request $request)
	{
		$pdf = ReportsUtilities::getPeopleWithoutPollingStation();
		$pdf->Output();

		return exit;
	}

	public function getPeopleOfLocations(Request $request)
	{
		$location_ids = $request->get('select');
		$pdf = ReportsUtilities::getPeopleOfLocations($location_ids);
		$pdf->Output();

		return exit;
	}

	public function getPeopleOfPollingStations(Request $request, $colaborator = null)
	{
		$polling_station_ids = $request->get('select');
		$rol_ids = $request->get('roles');

		$pdf = ReportsUtilities::getPeopleOfPollingStations($polling_station_ids, $rol_ids, $colaborator);
		$pdf->Output();

		return exit;
	}	

	public function getPeopleOfPollingStationsDayD(Request $request, $colaborator = null)
	{
		$polling_station_ids = $request->get('select');
		$rol_ids = $request->get('roles');

		$pdf = ReportsUtilities::getPeopleOfPollingStationsDayD($polling_station_ids, $rol_ids, $colaborator);
		$pdf->Output();

		return exit;
	}

	public function getPeopleOfCommunities(Request $request)
	{
		$community_ids = $request->get('select');
		$pdf = ReportsUtilities::getPeopleOfCommunities($community_ids);
		$pdf->Output();

		return exit;
	}

	public function getPeopleOfOccupations(Request $request)
	{
		$occupation_ids = $request->get('select');
		$pdf = ReportsUtilities::getPeopleOfOccupations($occupation_ids);
		$pdf->Output();

		return exit;
	}

	public function getTeamWithVoters(Request $request)
	{
		$team_ids = $request->get('select');
		$pdf = ReportsUtilities::getTeamWithVoters($team_ids);
		$pdf->Output();

		return exit;
	}

	public function getRecursiveTeam(Request $request)
	{
		$team_ids = $request->get('select');
		$pdf = ReportsUtilities::getRecursiveTeam($team_ids);
		$pdf->Output();

		return exit;
	}

	public function getRecursiveTeamVoters(Request $request)
	{
		$team_ids = $request->get('select');
		$pdf = ReportsUtilities::getRecursiveTeamVoters($team_ids);
		$pdf->Output();

		return exit;
	}

	public function getTeam(Request $request)
	{
		$pdf = ReportsUtilities::getTeam();
		$pdf->Output();

		return exit;
	}

	public function getTeamOfRoles(Request $request)
	{
		$rol_ids = $request->get('select');
		$pdf = ReportsUtilities::getTeamOfRoles($rol_ids);
		$pdf->Output();

		return exit;
	}

	public function getBlankTemplate(Request $request)
	{
		$team_ids = $request->get('select');
		$pdf = ReportsUtilities::reportStandard($team_ids);
		
		return exit;
	} 

	public function getPlans(Request $request)
	{
		$plan_ids = $request->get('select');
		$pdf = ReportsUtilities::getPlans($plan_ids);
		$pdf->Output();
		
		return exit;
	}

	public function getPlansTeam(Request $request)
	{
		$team_ids = $request->get('select');
		$pdf = ReportsUtilities::getPlansTeam($team_ids);
		$pdf->Output();

		return exit;
	}
}
