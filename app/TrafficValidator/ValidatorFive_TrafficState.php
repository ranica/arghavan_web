<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\GenderType;
use App\Enums\MessageGate;
use App\Enums\Directions;

class ValidatorFive_TrafficState extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {
        $lastDirect = is_null($trafficRow->direct_id) ? 0 : $trafficRow->direct_id;
        $gender_id = $trafficRow->gender_id;
        
        $gender =  $gender_id ? $baseRow->genZoneMan : $baseRow->genZoneWoman;

        switch ($gender) {
            // به تکرار تردد حساس نیست
            case '1':
                $result_array = \App\HelperTraffic\Logic\GateTraffic::prepareData($baseRow->gatedevice_id,
                                                                                    $baseRow->gatepass_id,
                                                                                    $trafficRow->user_id, 
                                                                                    MessageGate::allow, 
                                                                                    $traffic->direction, 
                                                                                    $traffic->serviceId);

                \App\HelperTraffic\Logic\GateTraffic::register_traffic_DB($result_array);
                return MessageGate::allow;
            break;
            
            // به تکرار تردد حساس است
            case '2':
                // اگر قبلا در جهت جاری عبور نکرده باشد مجوز دارد و به مرحله بعد برو
                if ($traffic->direction != $lastDirect)
                {
                    return $this->nextValidator->validate($baseRow, $trafficRow, $traffic);

                }

                return MessageGate::exists_pass;
            break;

            // تردد دوم اتوماتیک ثبت گردد

            case '3':
                if ($traffic->direction != $lastDirect)
                {
                    $result_array = \App\HelperTraffic\Logic\GateTraffic::prepareData($baseRow->gatedevice_id,
                                                                                    $baseRow->gatepass_id,
                                                                                    $trafficRow->user_id, 
                                                                                    MessageGate::allow, 
                                                                                    $traffic->direction, 
                                                                                    $traffic->serviceId);

                    \App\HelperTraffic\Logic\GateTraffic::register_traffic_DB($result_array);
                    return MessageGate::allow;

                }
                elseif ($lastDirect != 0) {
                    
                    $autoDirect = ($traffic->direction == Directions::input) ? Directions::output : Directions::input;

                    // ذخیره تردد جهت تکمیل تردد قبلی
                    $result_array_auto = \App\HelperTraffic\Logic\GateTraffic::prepareData($baseRow->gatedevice_id,
                                                                                    $baseRow->gatepass_id,
                                                                                    $trafficRow->user_id, 
                                                                                    MessageGate::store_by_auto, 
                                                                                    $autoDirect, 
                                                                                    $traffic->serviceId);

                    \App\HelperTraffic\Logic\GateTraffic::register_traffic_DB($result_array_auto);

                    // ذخیره تردد جدید
                    $result_array = \App\HelperTraffic\Logic\GateTraffic::prepareData($baseRow->gatedevice_id,
                                                                                    $baseRow->gatepass_id,
                                                                                    $trafficRow->user_id, 
                                                                                    MessageGate::allow, 
                                                                                    $traffic->direction, 
                                                                                    $traffic->serviceId);

                    \App\HelperTraffic\Logic\GateTraffic::register_traffic_DB($result_array);


                    return MessageGate::allow;
                    
                }
        }
    }
}