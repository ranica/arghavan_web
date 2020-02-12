<?php

namespace App\TrafficValidator;

abstract class BaseValidator {
	protected $nextValidator;

	/**
	 * Sets the next validator.
	 *
	 * @param      <BaseValidator>  $validator  The validator
	 */
	public function setNextValidator($validator) {
		$this->nextValidator = $validator;
	}

	public abstract function validate($baseRow, $trafficRow, $traffic);
}