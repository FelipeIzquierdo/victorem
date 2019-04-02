<?php namespace Victorem\Http\Controllers\Database;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;

use Victorem\Entities\Rol;
use Victorem\Http\Requests\Rol\CreateRequest;
use Victorem\Http\Requests\Rol\EditRequest;

use Illuminate\Database\QueryException;


class RolesController extends Controller {

	private $rol;

	public function __construct() 
	{
		$this->beforeFilter('@findRol', ['only' => ['edit', 'update', 'destroy']]);
		$this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Find a specified resource
	 *
	 */
	public function findRol(Route $route)
	{
		$this->rol = Rol::findOrFail($route->getParameter('roles'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rol = new Rol;
		$form_data = ['route' => 'database.roles.store', 'method' => 'POST'];

		return view('dashboard.pages.database.roles.lists', compact('form_data', 'rol'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
		$this->rol = new Rol;
		$this->rol->fill($request->all());
		$this->rol->save();
        
        return redirect()->route('database.roles.index');

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{		
		$form_data = ['route' => ['database.roles.update', $id], 'method' => 'PUT'];
		return view('dashboard.pages.database.roles.lists', compact('form_data'))
			->with(['rol' => $this->rol]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		$this->rol->fill($request->all());
		$this->rol->save();

        return redirect()->route('database.roles.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{		
		try {
			$this->rol->delete();			
			$result = array('msg' => $this->rol->name . ' eliminad@ exitosamente', 'success' => true, 'id' => $this->rol->id);
		} catch (QueryException $e) {
			$result = ['msg' => 'Solo se puede borrar un cargo que no tenga cargos inferiores 
				y que no se le hayan asignado Personas del equipo', 'success' => false, 'id' => $this->rol->id];
		}

        if ($request->ajax())
        {
            return $result;
        }
        else
        {
        	if($result['success'] == true)
        	{
        		return redirect()->route('database.roles.index');	
        	}

            return redirect()->route('database.roles.edit', $this->rol->id)->withInput()->with('result', $result);
        }
	}



}
