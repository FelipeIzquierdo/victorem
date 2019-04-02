<?php

namespace Victorem\Jobs;

use Victorem\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Victorem\Libraries\Sms\SendSMS;

class SendSmsMessage extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $voters;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($voters, $message)
    {
        $this->voters = $voters;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $sendSMS = new SendSMS();
        $sendSMS->sendMessageVoters($this->voters, $this->message);
    }
}
