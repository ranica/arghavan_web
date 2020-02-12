<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetTrafficRemoteRaspberry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IPASS:receive_raspberry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'receive traffic data from raspberry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start_date = \Carbon\Carbon::now ();
        $data = "\nStart at:\n".$start_date;

        echo $data;
        \Log::info ($data);

        $job = new \App\Jobs\GetTrafficRemoteRaspberry();
        // $job = new \App\Jobs\GetTrafficRemoteRaspberry()->hourly();

        $job->dispatch();

        $end_date = \Carbon\Carbon::now ();
        $data = "\nCompute GetTraffic Command run successfully!\nEnd at:\n".$end_date."\n";

        echo $data;
        \Log::info ($data);
    }
}
