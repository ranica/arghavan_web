<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessSendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $message = '';
    private $to = '';
    private $user_id = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to, $message, $user_id)
    {
        $this->to = $to;
        $this->message = $message;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $res = \Smsir::send([$this->message], [$this->to]);
        
        // Save $number, $message, $res into database
        \App\Sms::DBlog ($res, $this->message, $this->to, $this->user_id);

        $this->delete();
    }
}
