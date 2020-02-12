<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
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

    /**
     * Create new Warranty
     *     but before create check conflicts
     * @param  Request $request
     * @return Warranty         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $warranty = Warranty::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($warranty))
        {
            $newWarranty = Warranty::create([
                    'name' => $request->name,
                ]);

            return $newWarranty;
        }
        else
        {
            $warranty->restore();

            return $warranty;
        }

        return null;
    }
}
