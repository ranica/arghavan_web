<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Native extends Model
{
	// بویم یا غیر بومی
    public $timestamps = false;
    protected $guarded = [
    	'id'
    ];
}
