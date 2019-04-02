<?php namespace Victorem\Http\Controllers\System;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Victorem\Http\Requests\User\CreateRequest;
use Victorem\Http\Requests\User\EditRequest;

use Victorem\Entities\User;

class UsersController extends Controller {

	private $user;

	public function __construct() 
	{
		$this->beforeFilter('@newUser', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
		$this->middleware('logs', ['only' => ['store', 'update', 'destroy']]);
	}

	public function newUser()
	{
		$this->user = new User;
	}

	public function findUser(Route $route)
	{
	 	$this->user = User::findOrFail($route->getParameter('users'));
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::allPaginate();

		return view('dashboard.pages.system.users.lists', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form_data = ['route' => 'system.users.store', 'method' => 'POST'];

		return view('dashboard.pages.system.users.form', compact('form_data'))
			->with('user', $this->user);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->user->fill($request->all());
        $this->user->save();

		return redirect()->route('system.users.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('dashboard.pages.system.users.show', compact('user'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_data = ['route' => ['system.users.update', $this->user->id], 'method' => 'PUT'];

		return view('dashboard.pages.system.users.form', compact('form_data'))
			->with('user', $this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditRequest $request)
	{
        $this->user->fill($request->all());
        $this->user->save();

		return redirect()->route('system.users.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        $this->user->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario "' . $this->user->name . '" eliminado',
                'id'      => $this->user->id
            ));
        }
        else
        {
            return redirect()->route('system.users.index');
        }
	}
}
