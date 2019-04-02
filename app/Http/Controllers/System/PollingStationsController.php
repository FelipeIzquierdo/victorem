<?php namespace Victorem\Http\Controllers\System;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

use Victorem\Http\Controllers\Controller;
use Victorem\Entities\PollingStation;
use Victorem\Libraries\ReportsUtilities;

use Victorem\Http\Requests\PollingStation\CreateRequest;
use Victorem\Http\Requests\PollingStation\EditRequest;

class PollingStationsController extends Controller {

	private $polling_station;

	public function __construct() 
	{
		$this->beforeFilter('@newPollingStation', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findPollingStation', ['only' => ['edit', 'update']]);
	}

	/**
	 * A new instance of polling_station
	 *
	 */
	public function newPollingStation()
	{
		$this->polling_station = new PollingStation;
	}

	/**
	 * Find a specific polling_station
	 *
	 */
	public function findPollingStation(Route $route)
	{
		$this->polling_station = PollingStation::findOrFail($route->getParameter('polling_stations'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$polling_stations = PollingStation::with('location')->get();
		return view('dashboard.pages.system.polling_stations.lists', compact('polling_stations'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.polling-stations.store', 'method' => 'POST'];
		
		return view('dashboard.pages.system.polling_stations.form', compact('form_data'))
			->with('polling_station', $this->polling_station);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->polling_station->fill($request->all());
        $this->polling_station->save();

		return redirect()->route('system.polling-stations.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.polling-stations.update', $this->polling_station->id], 'method' => 'PUT'];
		
		return view('dashboard.pages.system.polling_stations.form', compact('form_data'))
			->with('polling_station', $this->polling_station);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
        $this->polling_station->fill($request->all());
        $this->polling_station->save();

		return redirect()->route('system.polling-stations.index');
	}
}
