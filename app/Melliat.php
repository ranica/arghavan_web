<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Melliat extends Model
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
     * Create new Melliat
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $melliat = Melliat::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($melliat))
        {
            $newMelliat = Melliat::create([
                    'name' => $request->name,
                ]);

            return $newMelliat;
        }
        else
        {
            $melliat->restore();

            return $melliat;
        }

        return null;
    }
}
