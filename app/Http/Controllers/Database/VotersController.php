<?php namespace Victorem\Http\Controllers\Database;

use Victorem\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Victorem\Http\Requests\Voter\CreateRequest;
use Victorem\Http\Requests\Voter\NewRequest;

use Illuminate\Routing\Route;

use Illuminate\Database\QueryException;

use Victorem\Libraries\WebScraping;

use Session;
use Event;

use Victorem\Events\VoterWasCreated;

use Victorem\Entities\Voter;
use Victorem\Entities\Location;


class VotersController extends Controller {

	private $nameRoute;
	private $oppositeRoute;
	private $nameView;
	private $colaborator;
	private $voters;
	private $voter;

	function __construct() {
 		$this->nameRoute = 'voters';
 		$this->oppositeRoute = 'team';
		$this->nameView = 'voter';
 		$this->colaborator = 0;

 		$this->beforeFilter('@getList', ['only' => ['index']]);
 		$this->beforeFilter('@findVoter', ['only' => ['diaries']]);
 		$this->middleware('logs', ['only' => ['store', 'destroy']]);
 	}

 	public function setNameRoute($nameRoute)
 	{
 		$this->nameRoute = $nameRoute;
 	}

 	public function getNameRoute()
 	{
 		return $this->nameRoute;
 	}

 	public function setOppositeRoute($oppositeRoute)
 	{
 		$this->oppositeRoute = $oppositeRoute;
 	}

 	public function getOppositeRoute()
 	{
 		return $this->oppositeRoute;
 	}

 	public function setNameView($nameView)
 	{
 		$this->nameView = $nameView;
 	}

 	public function getNameView()
 	{
 		return $this->nameView;
 	}

 	public function setColaborator($colaborator)
 	{
 		$this->colaborator = $colaborator;
 	}

 	public function getColaborator()
 	{
 		return $this->colaborator;
 	}

 	public function setVoters($voters)
 	{
 		$this->voters = $voters;
 	}

 	public function getVoters()
 	{
 		return $this->voters;
 	}

	public function getList(Route $route, Request $request)
	{
		$this->setVoters(Voter::votersPaginate(24, false, $request->get('order')));
	}

	public function findVoter(Route $route)
	{
		$this->voter = Voter::withAll()->whereDoc($route->getParameter('doc'))->firstOrFail();
	}

	/**
	 * Display voter list.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()) {
			return [$this->getVoters()->toJson()];
		}

		return view('dashboard.pages.database.voters.lists.'.$this->getNameView())
			->with(['voters' => $this->getVoters()]);
	}

	/**
	 * Change the friendly url
	 *
	 * @return Response
	 */

	public function redirect(NewRequest $request)
	{
		$doc = $request->get('doc');
		Voter::setTeamSession($request->get('colaborator'));

		if ($request->has('diary')) 
		{
			return redirect()->route('database.'.$this->getNameRoute().'.create', [$doc, $request->get('diary')]);
		}

		return redirect()->route('database.'.$this->getNameRoute().'.create', $doc);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($doc, $diary = null)
	{
		$voter = Voter::findwithTrashedOrNew($doc);

		if($voter->exists && $voter->colaborator != $this->getColaborator())
		{
			return redirect()->route('database.'. $this->getOppositeRoute().'.create', [$doc, $diary]);
		}

		$form_data = ['route' => ['database.'.$this->getNameRoute().'.store', $doc, $diary], 'method' => 'POST'];	

		return view('dashboard.pages.database.voters.forms.'.$this->getNameView(), compact('voter', 'form_data', 'pollingStation'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request, $doc, $diary = null)
	{
		$voter = $request->getVoter();
		$voter->saveAndSync($request->all(), $this->getColaborator());
		
		Event::fire(new VoterWasCreated($voter)); 

		if(! is_null($diary))
		{
			if(! $voter->diaries()->find($diary))
			{
				$voter->diaries()->attach($diary);
			}

			return redirect()->route('diary.people.index', $diary);	
		}

        return redirect()->route('database.'.$this->getNameRoute().'.index');
	}

	public function diaries(Request $request, $doc)
	{
		return view('dashboard.pages.database.voters.diaries')->with('voter', $this->voter);
	}

	/**
	 * Display a voter lists searched
	 *
	 * @return Response
	 */
	public function search(Request $request)
	{
		$text 	= trim($request->get('text'));
		$voters = Voter::searchLike($text);

		return view('dashboard.pages.database.voters.lists.search', compact('voters', 'text'));
	}

	public function addToTeam($id, $diary = null)
	{
		$voter = Voter::findOrFail($id);
		$voter->colaborator = 1;
		$voter->save();

		return redirect()->route('database.team.create', $voter->doc);
	}

	public function findName($doc)
	{
		//$webScraper = new WebScraping;
        //return response()->json( ['name' => $webScraper->runProcuraduria($doc)] );

        return response()->json();
	}

	public function findPollingStation($doc)
	{
		$voter = Voter::firstOrNew(['doc' => $doc]);
        return response()->json( ['result' => $voter->hasPollingStation()]);
	}

	public function destroy($id, Request $request)
	{
		$voter = Voter::findOrFail($id);
		try {
			$voter->delete();
			$result = array('msg' => $voter->name . ' eliminad@ exitosamente', 'success' => true, 'id' => $voter->id);
		} catch (QueryException $e) {
			$result = ['msg' => 'Solo se puede borrar un Votante que no tenga asignados más voters', 
				'success' => false, 'id' => $voter->id];
		}

        if ($request->ajax())
        {
            return $result;
        }
        else
        {
        	if($result['success'] == true)
        	{
        		return redirect()->route('database.'.$this->getNameRoute().'.index');	
        	}

            return redirect()->route('database.'.$this->getNameRoute().'.index', $voter->id)->withInput()->with('result', $result);
        }
	}
}
