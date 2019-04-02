<?php namespace Victorem\Http\Controllers\System;

use Illuminate\Routing\Route;
use Victorem\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Victorem\Http\Requests\Sms\CreateRequest;
use Victorem\Http\Requests\Sms\EditRequest;

use Victorem\Entities\Sms;

class SmsCrudController extends Controller {

	private $sms;

	public function __construct() 
	{
		$this->beforeFilter('@newSms', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findSms', ['only' => ['edit', 'update']]);
	}

	/**
	 * Default Form Diary
	 *
	 */
	private function viewForm($form_data)
	{
		return view('dashboard.pages.system.sms.form')->with([
			'sms' 			=> $this->sms, 
			'form_data' 	=> $form_data
		]);
	}

	/**
	 * A new instance of polling_station
	 *
	 */
	public function newSms()
	{
		$this->sms = new Sms;
	}

	/**
	 * Find a specific sms
	 *
	 */
	public function findSms(Route $route)
	{
		$this->sms = Sms::findOrFail($route->getParameter('sms'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$smss = Sms::orderBy('created_at')->get();
		return view('dashboard.pages.system.sms.lists', compact('smss'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.sms.store', 'method' => 'POST'];
		
		return $this->viewForm($form_data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->sms->fillAndSave($request->all());

		return redirect()->route('system.sms.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.sms.update', $this->sms->id], 'method' => 'PUT'];
		
		return $this->viewForm($form_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
        $this->sms->fillAndSave($request->all());
		
		return redirect()->route('system.sms.index');		
	}
}
