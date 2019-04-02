<?php namespace Victorem\Http\Controllers\Secondary;

use Illuminate\Routing\Route;
use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Victorem\Entities\Diary;

use Victorem\Http\Requests\Diary\CreateRequest;
use Victorem\Http\Requests\Diary\EditRequest;

use Victorem\Libraries\Reports\ReportsUtilities;

use Illuminate\Database\QueryException;

use Response;

class DiaryController extends Controller {

	private $diary;

	public function __construct() 
	{
		$this->beforeFilter('@newDiary', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findDiary', ['only' => ['edit', 'update', 'destroy']]);
		$this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Find a specific diary
	 *
	 */
	public function findDiary(Route $route)
	{
		$this->diary = Diary::findOrFail($route->getParameter('diary'));
	}

	/**
	 * A new instance of diary
	 *
	 */
	public function newDiary()
	{
		$this->diary = new Diary;
	}

	/**
	 * Default Form Diary
	 *
	 */
	private function viewForm($form_data)
	{
		return view('dashboard.pages.diary.form')->with([
			'diary'		=> $this->diary,
			'form_data' => $form_data
		]);
	}


	public function index()
	{
		$events = Diary::all();
		return view('dashboard.pages.diary.index', compact('events'));
	}

	public function json()
	{
		$events = [];

    	foreach (Diary::with('delegate', 'organizer', 'location', 'voters')->get() as $key => $event) 
    	{
            $events[$key] = $event->toArray();
            $events[$key]['start'] = $event->date . ' ' . $event->time;
            $events[$key]['end'] = $event->date . ' ' . $event->endtime;
            $events[$key]['title'] = $event->name;
            $events[$key]['location'] = $event->location->name;
            $events[$key]['time'] = $event->time_for_humans;
            $events[$key]['endtime'] = $event->endtime_for_humans;                        
            $events[$key]['delegate'] = $event->delegate->name . ' - tel: ' . $event->delegate->telephone;
            $events[$key]['organizer'] = $event->organizer->name . ' - tel: ' . $event->organizer->telephone;

            if ($event->delegate_id != 1) 
            {
            	$events[$key]['color']	= '#C43902';
            }            
    	}

    	return $events;
	}

	public function printDiary(Request $request)
	{
		$pdf = ReportsUtilities::printDiary($request->get('date'));
		$pdf->Output();

		return exit;
	}

	public function create()
	{		
		$form_data = ['route' => 'diary.store', 'method' => 'POST'];
		return $this->viewForm($form_data);
	}		

	public function store(CreateRequest $request)
	{			
		$this->diary->fillAndSave($request->all());
		return redirect()->route('diary.index');			
	}

	public function edit($id)
	{		
		$form_data = ['route' => ['diary.update', $id], 'method' => 'PUT'];
		return $this->viewForm($form_data);
	}	

	public function update($id, CreateRequest $request)
	{	
		$result = $this->diary->fillAndSave($request->all());

		if($request->ajax())
		{   	
	        return Response::json(['success' => $result, 'errors' => $this->diary->errors]);
	    }
	    else
	    {
			return redirect()->route('diary.index');
		}			

	}

	public function destroy($id, Request $request)
	{
		try {
			$this->diary->delete();
			$result = array('msg' => $this->diary->name . ' eliminad@ exitosamente', 'success' => true, 'id' => $this->diary->id);
		} catch (QueryException $e) {
			$result = ['msg' => 'Error :(', 'success' => false, 'id' => $this->diary->id];
		}

        if ($request->ajax())
        {
            return $result;
        }
        else
        {
        	if($result['success'] == true)
        	{
        		return redirect()->route('diary.index');	
        	}
        	else
        	{
        		return redirect()->route('diary.edit', $this->diary->id)->withInput()->with('result', $result);
        	}            
        }
	}

}