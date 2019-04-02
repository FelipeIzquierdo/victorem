<?php namespace Victorem\Http\Controllers\Extra;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Victorem\Http\Requests\Poll\CreateRequest;
use Victorem\Http\Requests\Poll\EditRequest;

use Victorem\Entities\Poll;
use Victorem\Entities\ViewPoll;

use Victorem\Http\Controllers\Controller;

class PollsController extends Controller
{
    private $poll;
    private $form_data;

    public function __construct() 
    {
        $this->beforeFilter('@findPoll', ['only' => ['update', 'show', 'stats', 'statsJson', 'destroy']]);
        $this->beforeFilter('@newPoll', ['only' => ['index', 'store']]);
        $this->middleware('logs', ['only' => ['store', 'show', 'update', 'destroy']]);
    }

    private function getFormView()
    {
        return view('dashboard.pages.polls.show')
            ->with(['poll' => $this->poll, 'form_data' => $this->form_data]);
    }

    private function savePoll($data)
    {
        $this->poll->fillAndSave($data);

        return redirect()->route('polls.show', [$this->poll->id]);
    }

    /**
     * A new instance of poll
     *
     */
    public function newPoll()
    {
        $this->poll = new Poll;
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->form_data = ['route' => 'polls.store', 'method' => 'POST'];

        return view('dashboard.pages.polls.lists')
            ->with(['poll' => $this->poll, 'form_data' => $this->form_data]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        return $this->savePoll($request->all() + ['active' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->form_data = ['route' => ['polls.update', $this->poll->id], 'method' => 'PUT'];

        return $this->getFormView();
    }

    /**
     * Display stats
     *
     * @param  int  $id
     * @return Response
     */
    public function stats($id)
    {
        return view('dashboard.pages.polls.stats')
            ->with(['poll' => $this->poll]);
    }

    /**
     * Display stats
     *
     * @param  int  $id
     * @return Response
     */
    public function statsJson($id)
    {        
        return [
            'calls'     => $this->poll->voterPolls()->calls()->get(),
            'questions' => ViewPoll::getJsonStats($this->poll->id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, EditRequest $request)
    {
        return $this->savePoll($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        //
    }
}
