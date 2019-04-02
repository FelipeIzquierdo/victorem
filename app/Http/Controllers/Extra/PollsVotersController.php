<?php namespace Victorem\Http\Controllers\Extra;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Victorem\Http\Requests\Poll\Question\CreateRequest;
use Victorem\Http\Requests\Poll\Question\EditRequest;

use Victorem\Entities\Poll;
use Victorem\Entities\Question;
use Victorem\Entities\Answer;
use Victorem\Entities\Location;
use Victorem\Entities\Voter;
use Victorem\Entities\VoterPoll;
use Flash;

use Victorem\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

class PollsVotersController extends Controller
{
    private $question;
    private $poll;
    private $form_data;

    public function __construct() 
    {
        $this->beforeFilter('@findPoll', ['only' => ['index', 'options', 'postOptions', 'create', 'store', 'edit', 'update']]);
        $this->beforeFilter('@findVoterPoll', ['only' => ['edit', 'update']]);

        $this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Find a specified resource
     *
     */
    public function findPoll(Route $route)
    {
        $this->poll = Poll::findOrFail($route->getParameter('polls'));
    }

    /**
     * Find a specified resource
     *
     */
    public function findVoterPoll(Route $route)
    {
        $this->voterPoll = $this->poll->voterPolls()->findOrFail($route->getParameter('voters'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function options($poll_id)
    {
        return view('dashboard.pages.polls.options')->with(['poll' => $this->poll]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postOptions(Request $request)
    {
        $location_ids = Location::getAllOrderIds($request->get('locations'));
        $community_ids = $request->get('communities');

        $request->session()->put('poll_locations', $location_ids);
        $request->session()->put('poll_communities', $community_ids);

        return redirect()->route('polls.voters.create', [$this->poll->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($poll_id, Request $request)
    {
        if(\Session::get('flash_notification.message'))
        {
            Flash::info(\Session::get('flash_notification.message'));
        }

        $location_ids = $request->session()->get('poll_locations');
        $community_ids = $request->session()->get('poll_communities');

        $voter = $this->poll->getVoterRamdom($location_ids, $community_ids);
        
        if( !is_null($voter))
        {
            $this->voterPoll = VoterPoll::create([
                'voter_id'  => $voter->id, 
                'user_id'   => \Auth::user()->id,
                'poll_id'   => $this->poll->id,
            ]);    
       
            return redirect()->route('polls.voters.edit', [$this->poll->id, $this->voterPoll->id]);
        }
        else
        {
            Flash::warning('Para esta selección en este sondeo no hay votantes disponibles');
            return redirect()->route('polls.voters.options', [$this->poll->id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($poll_id, $voterPoll_id, Request $request)
    {   
        $this->voterPoll = VoterPoll::find($voterPoll_id);
        $this->form_data = ['route' => ['polls.voters.update', $this->poll->id, $this->voterPoll->id], 'method' => 'PUT'];

        $allPolls = VoterPoll::getCount($poll_id);

        $allPollsToday = VoterPoll::getCountToday($poll_id);

        return view('dashboard.pages.polls.doit')->with([
            'voterPoll' => $this->voterPoll,
            'form_data' => $this->form_data,
            'allPolls'  => $allPolls,
            'allPollsToday'  => $allPollsToday
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($poll_id, $voterPoll_id, Request $request)
    {
        $this->voterPoll->fill($request->all());
        $this->voterPoll->save();

        $answers = array();

        if($questions = $request->get('questions'))
        {
            foreach ($questions as $question) {
                foreach ($question as $answer) {
                    array_push($answers, $answer);
                }
            }
        }

        $this->voterPoll->answers()->attach($answers);

        Flash::info('Sondeo realizado con éxito');

        return redirect()->route('polls.voters.create', [$this->poll->id]);
    }
}
