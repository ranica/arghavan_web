<?php

namespace App\TrafficValidator;

use App\TrafficValidator\BaseValidator;
use App\TrafficValidator\ValidatorOne_DateOptionGate;
use App\TrafficValidator\ValidatorTwo_UserState;
use App\TrafficValidator\ValidatorThree_Card;
use App\TrafficValidator\ValidatorFour_Gender;
use App\TrafficValidator\ValidatorFive_TrafficState;
use App\TrafficValidator\ValidatorSix_TrafficCheker;




class TrafficValidatorFactory {
   /* Validators chain */
   private static $validators;

    /// <summary>
    /// Make Chain
    /// </summary>
    /// <returns></returns>
    public static function chainValidtor()
    {
    	if (is_null(static::$validators)) {

    		$validatorOne_DateOptionGate    = new ValidatorOne_DateOptionGate();
            $validatorTwo_UserState         = new ValidatorTwo_UserState();
            $validatorThree_Card            = new ValidatorThree_Card();
            $validatorFour_Gender           = new ValidatorFour_Gender();
            $validatorFive_TrafficState     = new ValidatorFive_TrafficState();
            $validatorSix_TrafficCheker     = new ValidatorSix_TrafficCheker();

    		$validatorOne_DateOptionGate->setNextValidator($validatorTwo_UserState);
    		$validatorTwo_UserState->setNextValidator($validatorThree_Card);
    		$validatorThree_Card->setNextValidator($validatorFour_Gender);
    		$validatorFour_Gender->setNextValidator($validatorFive_TrafficState);
    		$validatorFive_TrafficState->setNextValidator($validatorSix_TrafficCheker);

    		return static::$validators = $validatorOne_DateOptionGate;
    	}

    	return static::$validators;
    }
}