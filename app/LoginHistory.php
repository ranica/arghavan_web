<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    /**
     * Guarded fields
     *
     * @var        array
     */
    protected $guarded = [
        "id"
    ];
}
