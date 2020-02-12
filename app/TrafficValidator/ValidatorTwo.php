<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\MessageGate;

class ValidatorTwo extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {
        $validate = false;  /* Check some condition */

        if ($validate == true) {
            return $this->$nextValidator->validate($baseRow, $trafficRow, $traffic);
        }
        else {
            return MessageGate::allow;
        }
    }
}
