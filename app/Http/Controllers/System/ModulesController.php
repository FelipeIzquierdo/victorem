<?php namespace Victorem\Http\Controllers\System;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Victorem\Entities\Module;

use Victorem\Http\Requests\Module\CreateRequest;
use Victorem\Http\Requests\Module\EditRequest;

class ModulesController extends Controller {

	private $module;

	public function __construct() 
	{
		$this->beforeFilter('@newModule', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findModule', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function newModule()
	{
	 	$this->module = new Module;
	} 

	public function findModule(Route $route)
	{
	 	$this->module = Module::findOrFail($route->getParameter('modules'));
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$modules = Module::all();

		return view('dashboard.pages.system.modules.lists', compact('modules'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.modules.store', 'method' => 'POST'];

		return view('dashboard.pages.system.modules.form', compact('form_data'))
			->with('module', $this->module);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->module->fillAndSave($request->all());
		
		return redirect()->route('system.modules.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('dashboard.pages.system.modules.show', compact('module'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.modules.update', $this->module->id], 'method' => 'PUT'];

		return view('dashboard.pages.system.modules.form', compact('form_data'))
			->with('module', $this->module);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
        $this->module->fillAndSave($request->all());
       
		return redirect()->route('system.modules.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        $this->module->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Modulo "' . $this->module->name . '" eliminado',
                'id'      => $this->module->id
            ));
        }
        else
        {
            return redirect()->route('system.modules.index');
        }
	}


}
