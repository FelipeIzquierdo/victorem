<?php namespace Victorem\Http\Controllers\Secondary;

use Illuminate\Http\Request;
use DB;

use Victorem\Http\Controllers\Controller;
use Victorem\Entities\Diary;


class LogisticController extends Controller {

	public function getIndex()
	{
		return view('dashboard.pages.logistic.hello');		
	}

}