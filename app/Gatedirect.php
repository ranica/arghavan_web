<?php

namespace App;
use App\Gatedevice;

use Illuminate\Database\Eloquent\Model;

class Gatedirect extends Model
{
   	protected $guarded = [
    	'id'
    ];

    public $timestamps = false;

    public function gatedevices()
    {
    	return $this->hasMany(Gatedevice::class);
    }
}
