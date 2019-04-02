<?php namespace Victorem\Listeners;

use Victorem\Events\VoterWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Victorem\Libraries\Sms\SendSMS;

class SmsWelcomeVoter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VoterWasCreated  $event
     * @return void
     */
    public function handle(VoterWasCreated $event)
    {
        if($event->voter->isNew())
        {
            $sms = new SendSMS(); 
            $sms->sendWelcome($event->voter);
        }
    }
}
