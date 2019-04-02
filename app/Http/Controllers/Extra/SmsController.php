<?php namespace Victorem\Http\Controllers\Extra;

use Victorem\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Victorem\Libraries\Sms\SendSMS;
use Victorem\Entities\Voter;
use Victorem\Entities\Community;
use Victorem\Entities\Rol;
use Victorem\Jobs\SendSmsMessage;

class SmsController extends Controller {
	
	function __construct() {
		$this->middleware('logs');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function getIndex()
	{
		return view('dashboard.pages.sms.sms');
	}

	public function postSend(Request $request)
	{
		$voters = Voter::getVotersWithTelephones($request->all());		
		$message = $request->get('message');

		$fileSms = Voter::getFileSms($voters, $message);

		return \CSV::setEncode('SJIS-win', 'UTF-8')->create($fileSms)->render();

		/*dd($fileSms);

		$job = (new SendSmsMessage($voters, $message))->delay(2);
		
		$this->dispatch($job);
			
		return view('dashboard.pages.sms.sends')->with('quantity', count($voters));*/
	}

}

?>