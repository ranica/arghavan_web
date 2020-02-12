<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\GenderType;
use App\Enums\MessageGate;
use App\Enums\Directions;

class ValidatorSix_TrafficCheker extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {

        $lastMessageTraffic = is_null($trafficRow->message_id) ? 0 : $trafficRow->message_id;

        switch ($lastMessageTraffic) {
            case '0':
            case MessageGate::dontPass:
            case MessageGate::licensed_by_user:
            case MessageGate::store_by_auto:
                
                $result_array = \App\HelperTraffic\Logic\GateTraffic::prepareData($baseRow->gatedevice_id,
                                                                                $baseRow->gatepass_id,
                                                                                $trafficRow->user_id, 
                                                                                MessageGate::allow, 
                                                                                $traffic->direction, 
                                                                                $traffic->serviceId);

                \App\HelperTraffic\Logic\GateTraffic::register_traffic_DB($result_array);
                return MessageGate::allow;
            break;
          
        }
        
    }
}