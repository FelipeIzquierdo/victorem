<?php namespace Victorem\Http\Controllers\Database;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataBaseController extends Controller {

	public function index()
	{
		return view('dashboard.pages.database.hello');
	}

}