<?php namespace Victorem\Http\Controllers\System;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller {

	public function getIndex()
	{
		return view('dashboard.pages.system.hello');
	}

}
