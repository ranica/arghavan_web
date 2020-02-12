<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CarPlateType extends Model
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

    protected $guarded = [
        'id'
    ];

    /**
     * Create new plate_type
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $plate_type = CarPlateType::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($plate_type))
        {
            $new_plate_type = CarPlateType::create([
                    'name' => $request->name,
                ]);

            return $new_plate_type;
        }
        else
        {
            $plate_type->restore();

            return $plate_type;
        }

        return null;
    }
}
