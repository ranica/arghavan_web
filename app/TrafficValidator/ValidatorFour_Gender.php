<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\GenderType;
use App\Enums\MessageGate;

class ValidatorFour_Gender extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {
        $gender_base = $baseRow->gender_id;
        $gender_user = $trafficRow->gender_id;

        if (($gender_base == GenderType::Both) or 
            ($gender_base == $gender_user))
        {
            
            return $this->nextValidator->validate($baseRow, $trafficRow, $traffic);
        }
        else {
            return MessageGate::mismatch_gender;
        }
    }
}