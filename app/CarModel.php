<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
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
     * Create new car_model
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $car_model = CarModel::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_model))
        {
            $new_car_model = CarModel::create([
                    'name' => $request->name,
                ]);

            return $new_car_model;
        }
        else
        {
            $car_model->restore();

            return $car_model;
        }

        return null;
    }
}
