<?php

namespace App\CommandParser;
use App\CommandParser\ICommand;
use App\HelperTraffic\Logic\GateTraffic as HelperTraffic;
use App\Enums\MessageGate;
use App\Enums\Directions;
use App\Enums\CommandType;

class Cmd53010 implements ICommand {

    public $successStatus = 200;
    public $failedStatus  = 401;

    /**
     * Execute command
     */
    public function execute($args)
    {
        $result_array = HelperTraffic::prepareData($args['gatedevice_id'],
                                                    $args['gatepass_id'],
                                                    $args['user_id'],
                                                    MessageGate::unknown_card,
                                                    Directions::input,
                                                    $args['service_id']);

        HelperTraffic::register_traffic_DB($result_array);

        return "[53010]";
    }
}
