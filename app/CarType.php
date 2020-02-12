<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarType extends Model
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
     * Create new car_type
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_type = CarType::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_type))
        {
            $new_car_type = CarType::create([
                    'name' => $request->name,
                ]);

            return $new_car_type;
        }
        else
        {
            $car_type->restore();

            return $car_type;
        }

        return null;
    }
}
