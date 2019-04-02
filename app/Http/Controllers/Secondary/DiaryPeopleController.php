<?php namespace Victorem\Http\Controllers\Secondary;

use Illuminate\Routing\Route;
use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Victorem\Entities\Diary;
use Victorem\Entities\Voter;

use Illuminate\Database\QueryException;

use Response;

class DiaryPeopleController extends Controller {

	private $diary;

	public function __construct() 
	{
		$this->beforeFilter('@findDiary');
		$this->middleware('logs', ['only' => ['store', 'getOutList']]);
	}

	/**
	 * Find a specific diary
	 *
	 */
	public function findDiary(Route $route)
	{
		$this->diary = Diary::findOrFail($route->getParameter('diary'));
	}

	public function index()
	{
		return view('dashboard.pages.diary.people')->with(['diary' => $this->diary]);
	}

	public function remove(Request $request, $diary_id, $id)
	{
		try {
			$this->diary->voters()->detach($id);
			$result = array('msg' => 'Votante eliminado de la asistencia exitosamente', 'success' => true, 'id' => $id);
		} catch (QueryException $e) {
			$result = ['msg' => 'El votante no pertenece a esta asistencia', 
				'success' => false, 'id' => $id];
		}

		if ($request->ajax())
        {
            return $result;
        }

		return redirect()->route('diary.people.index', $diary_id);
	}

	public function addMasive($diary_id, Request $request)
	{
		$docs = explode(",", trim($request->get('docs')));

		$votersOutsideAssistance = Voter::leftjoin('diary_voter', function($join) use ($diary_id) {
			$join->on('voters.id', '=', 'voter_id')
				->where('diary_id', '=', $diary_id);
		})
		->whereIn('doc', $docs)
		->whereNull('voter_id')
		->select('id')->lists('id')->all();

		$this->diary->voters()->attach($votersOutsideAssistance);

		$registerDocs = Voter::whereIn('doc', $docs)->lists('doc')->all();
		$unregisteredDocs = array_diff($docs, $registerDocs);

		return redirect()->route('diary.people.index', $diary_id)->with('unregisteredDocs', $unregisteredDocs);

	}

}