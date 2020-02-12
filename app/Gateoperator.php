<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\GateTraffic;
class Gateoperator extends Model
{
	use SoftDeletes;

	 /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

     /**
     * @var array
     */
    protected $guarded =[
    	'id'
    ];

     /**
     * Get Gate Tarffic
     */
    // public function gatetraffic()
    // {
    //     return $this->belongs(GateTraffic::class);
    // }
}
