<?php

namespace App\TrafficValidator;
use App\TrafficValidator\BaseValidator;
use App\Enums\MessageGate;

class ValidatorThree_Card extends BaseValidator{
    /**
     * Validate function
     *
     * @param      <type>  $baseRow     The base row
     * @param      <type>  $trafficRow  The traffic row
     * @param      <type>  $traffic     The traffic
     */
    public function validate($baseRow, $trafficRow, $traffic)
    {
       if (($trafficRow->card_end >= \Carbon\Carbon::now()) and 
            ($trafficRow->card_start) <= \Carbon\Carbon::now())
        {
            
            return $this->nextValidator->validate($baseRow, $trafficRow, $traffic);
        }
        else {
            return MessageGate::expaired_card;
        }
    }
}