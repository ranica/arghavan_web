<?php

namespace App;
use App\Gateoption;

use Illuminate\Database\Eloquent\Model;

class Gatezone extends Model
{
    /**
	 * @var boolean
	 */
    public $timestamps = false;

     protected $guarded = [
    	'id'
    ];

    /**
     * Return gate related options
     * @return [type] [description]
     */
    public function gateoptions()
    {
    	return $this->hasMany(Gateoption::class);
    }
}
