<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CarSystem extends Model
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
     * Create new car_system
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_system = CarSystem::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_system))
        {
            $new_car_system = CarSystem::create([
                    'name' => $request->name,
                ]);

            return $new_car_system;
        }
        else
        {
            $car_system->restore();

            return $car_system;
        }

        return null;
    }
}
