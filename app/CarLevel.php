<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarLevel extends Model
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
     * Create new car_level
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_level = CarLevel::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_level))
        {
            $new_car_level = CarLevel::create([
                    'name' => $request->name,
                ]);

            return $new_car_level;
        }
        else
        {
            $car_level->restore();

            return $car_level;
        }

        return null;
    }
}
