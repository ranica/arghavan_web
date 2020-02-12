<?php
namespace App\CommandParser;

use App\CommandParser\ICommand;
use App\CommandParser\CommandFactory;
use App\Enums\MessageGate;
use App\Enums\Directions;
use App\Enums\CommandType;
use App\HelperTraffic\Logic\GateTraffic as HelperTraffic;

use App\HelperTraffic\Traffic;
use App\HelperTraffic\Helper as HelperCollection;
use App\TrafficValidator\TrafficValidatorFactory;


class Cmd5408 implements ICommand {
    /**
     * Execute command
     */
    public function execute($args)
    {
        $USER_ID_UNKNOWN = \Config::get('core.user_id_unknown'); // default = 1
        $SERVICE_ID = \Config::get('core.service_id'); // default = 1
        $validator = TrafficValidatorFactory::chainValidtor();
        $direct = Directions::output;

        $ip = $args['ip'];
        $cdn = $args['cdn'];

        $current_date = \Carbon\Carbon::now()->setTimeZone('Asia/Tehran');
        $validator = \App\TrafficValidator\TrafficValidatorFactory::chainValidtor();

        $raw_base_gate = \DB::raw ("CALL sp_load_gate_device_by_ip('$ip');");
        $opResult_base_gate = \DB::select ($raw_base_gate);

        $raw_traffic_last_user= \DB::raw ("CALL sp_load_user_by_cdn('$cdn');");
        $opResult_traffic_last_user = \DB::select ($raw_traffic_last_user);

        // Unknow Device
        if (!isset($opResult_base_gate) || empty($opResult_base_gate))
        {
            return MessageGate::unknown_device;
        }

        $gateData = $opResult_base_gate[0];

         // Unknow Card
        if (!isset($opResult_traffic_last_user) || empty($opResult_traffic_last_user))
        {

            $res = CommandFactory::runCommand(CommandType::CMD_54010, ["ip" => $ip,
                                                                       "resultType" => MessageGate::unknown_card,
                                                                       "gatedevice_id" => $gateData->gatedevice_id,
                                                                       "gatepass_id" => $gateData->gatepass_id,
                                                                       "user_id" => $USER_ID_UNKNOWN,
                                                                       "service_id" =>$SERVICE_ID]);

            return $res;
        }

        $personData =  $opResult_traffic_last_user[0];

        $traffic = new Traffic();

        $traffic->cdn = $personData->cdn;
        $traffic->ip = $gateData->ip;
        $traffic->serviceId = $SERVICE_ID;
        $traffic->direction = $direct;
        $traffic->userId = $personData->user_id;
        $traffic->dateReceive =  \Carbon\Carbon::now();

        $result = $validator->validate($gateData, $personData, $traffic);

        if ($result == MessageGate::allow)
        {
            return "[54011]";
        }
        else {
            return "[54010]";
        }
    }
}
