<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\MessageGate;

class ValidatorOne_DateOptionGate extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {
        if (($baseRow->gate_option_end >= \Carbon\Carbon::now()) and
            ($baseRow->gate_option_start) <= \Carbon\Carbon::now())
        {

            return $this->nextValidator->validate($baseRow, $trafficRow, $traffic);
        }
        else {
            return MessageGate::expaired_department;
        }
    }
}
