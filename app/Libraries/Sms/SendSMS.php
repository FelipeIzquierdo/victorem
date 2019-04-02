<?php namespace Victorem\Libraries\Sms;

use Victorem\Libraries\Sms\Elibom\ElibomClient;
use Victorem\Libraries\Campaing;
use Exception;
use Log;

class SendSMS
{
	private $elibom;	

	function __construct() {
		$this->elibom = new ElibomClient(Campaing::getElibomUsername(), Campaing::getElibomCode());
	}

	public function credits()
	{
		try {
			$credits = $this->elibom->getAccount()->credits;
		} catch (Exception $e) {
			$credits = '00';
		}

		return $credits;
	}

	public function saveLogError()
	{
		Log::warning('Conexión fallida a Elibom');
	}

	public function sendWelcome($voter)
	{
		if($this->credits() > 0)
		{
			$deliveryId = $this->elibom->sendMessage($voter->telephone, $voter->welcome_message);	
			Log::info('Mensaje de bienvenido enviado a ' . $voter->telephone . ' con resultado ' . $deliveryId);

			return true;
		}

		$this->saveLogError();								
	}

	public function sendMessageVoters($voters, $message)
	{			
		if($this->credits() > 0)
		{
			foreach ($voters as $voter) 
			{
				$deliveryId = $this->elibom->sendMessage($voter->telephone, $voter->getTextMessage($message));							
			}	

			return true;
		}

		$this->saveLogError();								
	}

	public function send($numbers, $message)
	{	
		if($this->credits() > 0)
		{
			foreach ($numbers as $number) 
			{		
				$deliveryId = $this->elibom->sendMessage($number, $message);							
			}	

			return true;
		}

		$this->saveLogError();								
	}

	public function sendCustomMessages($numbers)
	{	
		if($this->credits() > 0)
		{
			foreach ($numbers as $number) 
			{		
				$deliveryId = $this->elibom->sendMessage($number['telephone'], $number['message']);	
				Log::info('Mensaje ' . $number['message'] . ' enviado a ' . $number['telephone'] . ' con resultado ' . $deliveryId);			
			}	

			return true;
		}	

		$this->saveLogError();							
	}
}	

?>