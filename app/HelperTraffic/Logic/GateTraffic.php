<?php

namespace App\HelperTraffic\Logic;
use App\HelperTraffic\Helper;

class GateTraffic
{

    /**
     * Register Traffic in DB
     *
     * @param      <type>  $list   The list
     */
    public static function register_traffic_DB($list)
    {
        $userId = $list["user_id"];
        $gatedeviceId = $list["gate_id"];
        $gatepassId = $list["gate_pass_id"];
        $gatedirectId = $list["gate_direct_id"];
        $gatemessageId = $list["gate_message_id"];
        $gateoperatorId = $list["gate_operator_id"];

        /* TODO: USE PARAMETRIC FORM  */
        $raw_base_gate = \DB::select ("CALL sp_register_traffic('$userId',
                                                                '$gatedeviceId',
                                                                '$gatepassId',
                                                                '$gatedirectId',
                                                                '$gatemessageId',
                                                                '$gateoperatorId');");
    }

    /**
     * Prepare Data
     */

    public static function prepareData($gatedevice_id,
                                      $gatepass_id,
                                      $user_id,
                                      $gatemessage_id,
                                      $gatedirect_id,
                                      $gateoperator_id)
    {
        $array_data = array();
        $array_data["user_id"] = $user_id;
        $array_data["gate_id"] = $gatedevice_id;
        $array_data["gate_pass_id"] = $gatepass_id;
        $array_data["gate_direct_id"] = $gatedirect_id;
        $array_data["gate_operator_id"] = $gateoperator_id;
        $array_data["gate_message_id"] = $gatemessage_id;

        return $array_data;
    }

    /**
     * Update Traffic in DB
     *
     * @param      <type>  $cdn             The cdn
     * @param      <type>  $gatemessage_id  The gatemessage identifier
     * @param      <type>  $direct          The direct
     */
    public static function update_traffic_DB($cdn, $gatemessage_id, $direct)
    {
        $raw_base_gate = \DB::select ("CALL sp_update_traffic('$cdn', '$gatemessage_id', '$direct');");
    }
}
