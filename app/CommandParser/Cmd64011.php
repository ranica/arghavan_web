<?php
namespace App\CommandParser;

use App\CommandParser\ICommand;
use App\HelperTraffic\Logic\GateTraffic as HelperTraffic;
use App\Enums\MessageGate;
use App\Enums\Directions;
use App\Enums\CommandType;

class Cmd64011 implements ICommand {

    public $successStatus = 200;
    public $failedStatus  = 401;

    /**
     * Execute command
     */
    public function execute($args)
    {
        $ip = $args['ip'];
        $cdn = $args['cdn'];

       HelperTraffic::update_traffic_DB($cdn, MessageGate::pass, Directions::output);
    }
}



