<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    use SoftDeletes;

    /**
     * @var Guarded Array
     */
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

    /**
     * Create new Part
     *     but before create check conflicts
     * @param  Request $request
     * @return Part         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $partCount = Part::where('name', $request->name)
            ->get()
            ->count();

        if (0 == $partCount)
        {
            $newPart = Part::create([
                'name' => $request->name
            ]);

            return $newPart;
        }

        return null;
    }
}
