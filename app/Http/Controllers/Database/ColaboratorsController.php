<?php namespace Victorem\Http\Controllers\Database;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Victorem\Entities\Voter;

class ColaboratorsController extends VotersController {

 	function __construct() {
 		$this->setNameRoute('team');
 		$this->setOppositeRoute('voters');
		$this->setNameView('team');
 		$this->setColaborator(1);

 		$this->beforeFilter('@getList', ['only' => ['index']]);
 		$this->middleware('logs', ['only' => ['store', 'destroy']]);
 	}

 	private function redirectToCorrectRoute($doc)
	{
		return redirect()->route('database.voters.create', $doc);
	}

	public function getList(Route $route, Request $request)
	{
		$this->setVoters(Voter::teamPaginate(12));
	}

	public function remove($doc, $diary = null)
	{
		$voter = Voter::whereDoc($doc)->first();
		$voter->colaborator = false;
		$voter->save();

		if(! is_null($diary))
		{
			return redirect()->route('diary.people.index', $diary);	
		}

		return redirect()->route('database.team.index');
	}



}
