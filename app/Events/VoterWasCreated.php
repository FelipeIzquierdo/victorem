<?php

namespace Victorem\Events;

use Victorem\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Victorem\Entities\Voter;

class VoterWasCreated extends Event
{
    use SerializesModels;

    public $voter;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Voter $voter, $data = array()) 
    {
        $this->voter = $voter;
        $this->data = $data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
