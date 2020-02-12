<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kintype extends Model
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

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

   
    /**
     * Create new Kin Type
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {       
        $kintype = Kintype::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($kintype))
        {
            $newKintype = Kintype::create([
                    'name' => $request->name,
                ]);

            return $newKintype;
        }
        else
        {
            $kintype->restore();

            return $kintype;
        }

        return null;
    }
}
