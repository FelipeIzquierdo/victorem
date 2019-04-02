<?php namespace Victorem\Libraries\Reports;

use Victorem\Entities\Voter;
use Victorem\Entities\Rol;
use Victorem\Entities\Location;
use Victorem\Entities\PollingStation;
use Victorem\Entities\Diary;
use Victorem\Entities\Community;
use Victorem\Entities\Occupation;
use Victorem\Entities\Poll;

use Victorem\Libraries\Campaing;
use Victorem\Libraries\Fpdf\Report;
use Victorem\Libraries\Fpdf\ReportTable;
use Victorem\Entities\User;


use PDF;

class ReportsUtilities
{

	public static function getPeople($sex)
	{
		$voters = Voter::withSex($sex);
		
		$pdf = new ReportTable('L', 'mm', 'Legal');
		$pdf->init(Campaing::getCandidateName(), 'Todos los Votantes');	
		$pdf->voters($voters);
		
		return $pdf;	
	}

	public static function getUsers()
	{
		$users = User::all();
		
		$pdf = new ReportTable('L', 'mm', 'Legal');
		$pdf->init(Campaing::getCandidateName(), 'Todos los Usuarios', 10);	
		$pdf->users($users);
		
		return $pdf;	
	}

	public static function getVoterPolls($poll_id)
	{
		$poll = Poll::findOrFail($poll_id);
		$voterPolls = $poll->voterPolls()->realized()->with('voter', 'answers')->get();
		
		$pdf = new ReportTable('L', 'mm', 'Legal');
		$pdf->init(Campaing::getCandidateName(), 'Sondeo: ' . $poll->name, 9);	
		$pdf->voterPolls($poll, $voterPolls);
		
		return $pdf;	
	}

	public static function getDelegates()
	{
		$voters = Voter::where('delegate', '=', 1)->get();
		
		$pdf = new ReportTable('L', 'mm', 'Legal');
		$pdf->init(Campaing::getCandidateName(), 'Delegados de Campaña');	
		$pdf->voters($voters);
		
		return $pdf;	
	}

	public static function getPeopleWithBirthdayCurrentMonth()
	{
		$voters = Voter::withBirthdayCurrentMonth();

		$pdf = new ReportTable('L', 'mm', 'Legal');
		$pdf->init(Campaing::getCandidateName(), 'Personas con cumpleaños '.date('m-Y'));	
		$pdf->voters($voters);
		
		return $pdf;	
	}

	public static function getPeopleWithoutPollingStation()
	{
		$voters = Voter::whereNullPollingStation();

		$pdf = new ReportTable('L', 'mm', 'Legal');
        $pdf->init(Campaing::getCandidateName(), 'Personas sin puesto de votación');
		$pdf->votersWithSuperior($voters);
		
		return $pdf;
	}

	public static function getPeopleOfLocations($locations_id = [])
	{
		$locations = Location::withVoters($locations_id);
		$pdf = new ReportTable('L', 'mm', 'Legal');

		self::getPeopleOfLocationsReport($locations, $pdf);

		return $pdf;	
	}

	public static function getPeopleOfLocationsReport($locations, $pdf)
	{
		foreach($locations as $location) 
		{
			if($location->voters->count() > 0)
			{
				$pdf->init(Campaing::getCandidateName(), 'Votantes por Ubicaciones - ' . $location->name);	
				$pdf->voters($location->voters);
			}
			
			self::getPeopleOfLocationsReport($location->childrenLocations, $pdf);
		}
	}

	public static function getPeopleOfPollingStations($polling_station_ids = [], $rol_ids = [], $colaborator = null)
	{
		$pollingStations = PollingStation::withVoters($polling_station_ids, $rol_ids, $colaborator);
		$roles = Rol::whereIn('id', $rol_ids)->get()->implode('name', ', ');

		if(! is_null($colaborator) && $colaborator == '1')
		{
			$pre_title = 'Equipo';
		}
		else if($colaborator == '0')
		{
			$pre_title = 'Solo Votantes';
		}
		else
		{
			$pre_title = 'Votantes';
		}

		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($pollingStations as $key => $pollingStation) 
		{
			$title = $pre_title . ' por Puesto de Votación' . ' - ' . $pollingStation->description;
			if($roles)
			{
				$title .= ' - Cargos (' . $roles . ')';
			}

			$pdf->init(Campaing::getCandidateName(), $title);	
			$pdf->votersPollingStation($pollingStation->voters->sortBy('superior_name'));

			$pdf->Ln();
			$pdf->SetFont('Arial', 'B', 13);
			$pdf->Cell(0, 7, utf8_decode('Ubicaciones'), 0, 1, 'L');

			$votersCollection = $pollingStation->voters->groupBy('location_recursive_name');
			$locations = [];

			foreach ($votersCollection as $location_name => $voters) 
			{
				$locations[$location_name]['name'] = $location_name;
				$locations[$location_name]['number_voters'] = $voters->count();
			}
			
			$pdf->locations(collect($locations)->sortByDesc('number_voters'));
		}
		
		return $pdf;	
	}

	public static function getPeopleOfPollingStationsDayD($polling_station_ids = [], $rol_ids = [], $colaborator = null)
	{
		$pollingStations = PollingStation::withVotersDayD($polling_station_ids, $rol_ids, $colaborator);
		
		$roles = Rol::whereIn('id', $rol_ids)->get()->implode('name', ', ');

		if(! is_null($colaborator) && $colaborator == '1')
		{
			$pre_title = 'Equipo';
		}
		else if($colaborator == '0')
		{
			$pre_title = 'Solo Votantes';
		}
		else
		{
			$pre_title = 'Votantes';
		}

		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($pollingStations as $key => $pollingStation) 
		{
			$title = $pre_title . ' UBICADOS por Puesto de Votación' . ' - ' . $pollingStation->description;
			if($roles)
			{
				$title .= ' - Cargos (' . $roles . ')';
			}

			$pdf->init(Campaing::getCandidateName(), $title);	
			$pdf->votersPollingStation($pollingStation->votersDayD->sortBy('superior_name'));

			$pdf->Ln();
			$pdf->SetFont('Arial', 'B', 13);
			$pdf->Cell(0, 7, utf8_decode('Ubicaciones'), 0, 1, 'L');

			$votersCollection = $pollingStation->votersDayD->groupBy('location_recursive_name');
			$locations = [];

			foreach ($votersCollection as $location_name => $voters) 
			{
				$locations[$location_name]['name'] = $location_name;
				$locations[$location_name]['number_voters'] = $voters->count();
			}
			
			$pdf->locations(collect($locations)->sortByDesc('number_voters'));
		}
		
		return $pdf;	
	}

	public static function getPeopleOfOccupations($occupations_id = [])
	{
		$occupations = Occupation::withVoters($occupations_id);
		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($occupations as $occupation) 
		{
			$title = 'Votantes por Ocupación' . ' - ' . $occupation->name;
			$pdf->init(Campaing::getCandidateName(), $title);	
			$pdf->voters($occupation->voters);
		}
		
		return $pdf;			
	}

	public static function getPeopleOfCommunities($communities_id = [])
	{
		$communities = Community::withVoters($communities_id);
		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($communities as $community) 
		{
			$title = 'Votantes por Comunidades' . ' - ' . $community->name;
			$pdf->init(Campaing::getCandidateName(), $title);	
			$pdf->voters($community->voters);
		}
		
		return $pdf;		
	}

	public static function getTeam()
	{
		$team = Voter::getTeamWithVoters()->sortByDesc('number_voters');

		$pdf = new ReportTable('L', 'mm', 'Legal');
        $pdf->init(Campaing::getCandidateName(), 'Equipo de Campaña');
		$pdf->team($team);
		
		return $pdf;	
	}

	public static function getTeamWithVoters($team_ids = [])
	{
		$team = Voter::getTeamWithVoters($team_ids);
		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($team as $colaborator) 
		{
			$pdf->init(Campaing::getCandidateName(), $colaborator->name . ', teléfono: '.$colaborator->telephone);	
			$pdf->voters($colaborator->voters);
		}
		
		return $pdf;
	}

	public static function getRecursiveTeam($team_ids = [])
	{
		$team = Voter::with(['voters' => function($query){
			$query->isTeam()
			->orderBy('name', 'asc');
		},'voters.voters' => function($query){
			$query->isTeam()
			->orderBy('name', 'asc');
		},'voters.voters.voters' => function($query){
			$query->isTeam()
			->orderBy('name', 'asc');
		},'voters.voters.voters.voters' => function($query){
			$query->isTeam()
			->orderBy('name', 'asc');
		},'voters.voters.voters.voters.voters' => function($query){
			$query->isTeam()
			->orderBy('name', 'asc');
		}])
		->isTeam()
		->whereIn('id', $team_ids)->get();

		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($team as $colaborator) 
		{
			$pdf->init(Campaing::getCandidateName(), 'Equipo de Campaña - ' . $colaborator->name, 10);	
			$pdf->recursiveTeam($colaborator->voters->sortByDesc('number_voters'));

			self::recursiveReportTeam($colaborator, $pdf);
		}
		
		return $pdf;
	}

	public static function getRecursiveTeamVoters($team_ids = [])
	{
		$team = Voter::with(['voters.voters.voters.voters.voters.voters' => function($query){
			$query->orderBy('colaborator', 'desc')
				->orderBy('name', 'asc');
		}])
		->whereIn('id', $team_ids)->get();

		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($team as $colaborator) 
		{
			$pdf->init(Campaing::getCandidateName(), 'Equipo de Campaña y Votantes - ' . $colaborator->name, 10);	
			$pdf->recursiveTeam($colaborator->voters->sortByDesc('number_voters'));

			self::recursiveReportTeam($colaborator, $pdf);
		}
		
		return $pdf;
	}

	private static function recursiveReportTeam($colaborator, $pdf)
	{
		foreach ($colaborator->voters->sortByDesc('number_voters') as $voter) 
		{
			if($voter->voters->count() >= 1)
			{
				$pdf->init(Campaing::getCandidateName(), $voter->title_report, 10);	
				$pdf->recursiveTeam($voter->voters->sortByDesc('number_voters'));

				self::recursiveReportTeam($voter, $pdf);
			}
		}
	}


	public static function getTeamOfRoles($rol_ids = [])
	{
		$roles = Rol::withTeam($rol_ids)->get();

		$pdf = new ReportTable('L', 'mm', 'Legal');

		foreach($roles as $rol) 
		{
			$pdf->init(Campaing::getCandidateName(), $rol->name, 8);	
			$pdf->teamOfRoles($rol->voters->sortBy('superior_name_with_roles'));
		}
		
		return $pdf;
	}

	

	public static function getTemplatesOfTeam($team_ids = [])
	{
		$team = Voter::getTeam($team_ids);
		$pdf = new ReportTable('L', 'mm', 'Legal');
        
		foreach($team as $colaborator) 
		{
			$pdf->init(Campaing::getCandidateName(), $colaborator->name . ', teléfono: '.$colaborator->telephone);	
			$pdf->blank();
		}
		
		$pdf->Output();
	}

	public static function printDiary($date = null){
		if(is_null($date))
		{
			$date = date('d-m-Y');
		}

		$title = 'Agenda de '. $date;
		$events = Diary::where('date', '=', $date)->orderBy('time', 'ASC')->get();

		$pdf = new Report('P', 'mm', 'A4');
		$pdf->init(Campaing::getCandidateName(), $title);

		foreach($events as $item => $event) {
			$pdf->SetFont('Arial','B',14);
			$pdf->Cell(0,10, $event->name .' por '. $event->organizer->name, 'LRT', 1);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(0,8,'Hora: ' . $event->time_to_endtime, 'LR', 1);
			$pdf->Cell(0,8, 'Lugar: ' . $event->location->name . ', ' . $event->place, 'LR', 1);			
			$pdf->Cell(0,8, 'Organizador: ' . $event->organizer->name . ', ' . $event->organizer->telephone , 'LR', 1);				
			$pdf->Cell(0,8, 'Delegado: ' . $event->delegate->name . ', ' . $event->delegate->telephone , 'LR', 1);
			$pdf->Cell(0,8, 'Cantidad de personas: ' . $event->people, 'LR', 1);
				
			if(!empty($event->logistic)) {
				$pdf->Cell(0,8,'Logistica: ' . $event->logistic, 'LR', 1);
			}
			if(!empty($event->advertising)) {
				$pdf->Cell(0,8,'Publicidad: ' . $event->advertising, 'LR', 1);
			}
			$pdf->Cell(0,8,'Notas: ' . $event->description, 'LRB', 1);
			$pdf->Ln();
		}		

		return $pdf;
	}

	public static function getPlans($plan_ids)
	{	
		$pdf = new ReportTable('L', 'mm', 'Letter');

		foreach ($plan_ids as $plan_id) 
		{	
			$plan = ReportTable::$plans[$plan_id];
			$pdf->init(Campaing::getCandidateName(), 'Plan 1x'.$plan, false);	
			$pdf->planBlank($plan);
		}
		
		return $pdf;	
	}

	public static function getPlansTeam($team_ids)
	{	
		$team = Voter::getTeamWithVoters($team_ids);
		$pdf = new ReportTable('L', 'mm', 'Letter');

		foreach($team as $colaborator) 
		{
			$plan = ReportTable::findPlan($colaborator->voters->count());
			$pdf->init(Campaing::getCandidateName(), 'Plan 1x' . $plan);	
			$pdf->planTeam($colaborator, $plan);
		}
		
		return $pdf;	
	}

}

?>