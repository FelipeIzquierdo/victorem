<?php namespace Victorem\Listeners;

use Victorem\Events\VoterWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Victorem\Libraries\MailChimpUtilities;

class AddVoterMailchimp
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
     * @param  Events  $event
     * @return void
     */
    public function handle(VoterWasCreated $event)
    {
        MailChimpUtilities::subscribeMailChimp($event->data);
    }
}
