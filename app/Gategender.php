<?php

namespace App;
use App\Gatedevice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gategender extends Model
{
    use SoftDeletes;

    protected $guarded = [
    	'id'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public $timestamps = false;

     public function gatedevices()
    {
    	return $this->hasMany(Gatedevice::class);
    }
}
