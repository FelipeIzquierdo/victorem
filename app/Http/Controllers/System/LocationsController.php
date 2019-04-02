<?php namespace Victorem\Http\Controllers\System;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

use Victorem\Http\Controllers\Controller;
use Victorem\Entities\Location;

use Victorem\Http\Requests\Location\CreateRequest;
use Victorem\Http\Requests\Location\EditRequest;

class LocationsController extends Controller {

	private $location;

	public function __construct() 
	{
		$this->beforeFilter('@newLocation', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findLocation', ['only' => ['edit', 'update']]);
	}

	/**
	 * A new instance of location
	 *
	 */
	public function newLocation()
	{
		$this->location = new Location;
	}

	/**
	 * Find a specific location
	 *
	 */
	public function findLocation(Route $route)
	{
		$this->location = Location::findOrFail($route->getParameter('locations'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = Location::with('type', 'superiorLocation')->get();	

		return view('dashboard.pages.system.locations.lists', compact('locations'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.locations.store', 'method' => 'POST'];
		
		return view('dashboard.pages.system.locations.form', compact('form_data'))
			->with('location', $this->location);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->location->fill($request->all());
        $this->location->save();

		return redirect()->route('system.locations.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.locations.update', $this->location->id], 'method' => 'PUT'];
		
		return view('dashboard.pages.system.locations.form', compact('form_data'))
			->with('location', $this->location);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
        $this->location->fill($request->all());
        $this->location->save();

		return redirect()->route('system.locations.index');
	}
}
