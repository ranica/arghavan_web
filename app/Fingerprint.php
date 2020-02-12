<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fingerprint extends Model
{
    use SoftDeletes;

	 /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates   = [
        'deleted_at'
    ];
     /**
     * @return Get user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
