<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarFuel extends Model
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
     * Create new car_fuel
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_fuel = CarFuel::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_fuel))
        {
            $new_car_fuel = CarFuel::create([
                    'name' => $request->name,
                ]);

            return $new_car_fuel;
        }
        else
        {
            $car_fuel->restore();

            return $car_fuel;
        }

        return null;
    }
}
