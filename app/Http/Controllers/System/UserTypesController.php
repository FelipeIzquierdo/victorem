<?php namespace Victorem\Http\Controllers\System;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;

use Victorem\Http\Controllers\Controller;
use Victorem\Entities\UserType;

use Victorem\Http\Requests\UserType\CreateRequest;
use Victorem\Http\Requests\UserType\EditRequest;

class UserTypesController extends Controller {

	private $user_type;

	public function __construct() 
	{
		$this->beforeFilter('@newUserType', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findUserType', ['only' => ['edit', 'update']]);
		$this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
	}

	public function newUserType()
	{
		$this->user_type = new UserType;
	}

	/**
	 * Find a specific user_type
	 *
	 */
	public function findUserType(Route $route)
	{
		$this->user_type = UserType::findOrFail($route->getParameter('user_types'));
		
		if($this->user_type->system)
		{
			abort('404');
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user_types = UserType::allPaginate();
		return view('dashboard.pages.system.user_types.lists', compact('user_types'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.user-types.store', 'method' => 'POST'];

		return view('dashboard.pages.system.user_types.form', compact('form_data'))
			->with('user_type', $this->user_type);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->user_type->fillAndSave($request->all());

        return redirect()->route('system.user-types.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('dashboard.pages.system.user_types.show', compact('user_type'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.user-types.update', $this->user_type->id], 'method' => 'PUT'];

		return view('dashboard.pages.system.user_types.form', compact('form_data'))
			->with('user_type', $this->user_type);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
		$this->user_type->fillAndSave($request->all());

		return redirect()->route('system.user-types.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        $this->user_type->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Tipo de Usuario "' . $this->user_type->name . '" eliminado',
                'id'      => $this->user_type->id
            ));
        }
        else
        {
            return redirect()->route('system.user-types.index');
        }
	}


}
