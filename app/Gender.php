<?php

namespace App;

use App\People;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public $timestamps = false;
    
    protected $guarded = [
    	'id' 
    ]; 

    public function peoples()
    {
    	return $this->hasMany(People::class);
    }
}
