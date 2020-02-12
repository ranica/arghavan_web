<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarColor extends Model
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
     * Create new car_color
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_color = CarColor::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_color))
        {
            $new_car_color = CarColor::create([
                    'name' => $request->name,
                ]);

            return $new_car_color;
        }
        else
        {
            $car_color->restore();

            return $car_color;
        }

        return null;
    }
}
