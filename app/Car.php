<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

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
     * @var array
     */
    protected $appends = [
        'stateStr'
    ];

    /*
    Get user
     */
    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }

    /*
    Get  Car Color
     */
    public function carColor()
    {
        return $this->belongsTo(\App\CarColor::class);
    }

    /*
    Get Car Type
     */
    public function carType()
    {
        return $this->belongsTo(\App\CarType::class);
    }

    /*
    Get  Car Level
     */
    public function carLevel()
    {
        return $this->belongsTo(\App\CarLevel::class);
    }

    /*
    Get  Car System
     */
    public function carSystem()
    {
        return $this->belongsTo(\App\CarSystem::class);
    }
     /*
    Get  Car Model
     */
    public function carModel()
    {
        return $this->belongsTo(\App\CarModel::class);
    }
     /*
    Get  Car Fuel
     */
    public function carFuel()
    {
        return $this->belongsTo(\App\CarFuel::class);
    }

    /*
    Get Car Plate Type
     */
    public function carPlateType()
    {
        return $this->belongsTo(\App\CarPlateType::class);
    }

     /*
    Get Car Plate City
     */
    public function carPlateCity()
    {
        return $this->belongsTo(\App\CarPlateCity::class);
    }

     /*
    Get Card
     */
    public function card()
    {
        return $this->belongsTo(\App\Card::class);
    }
    /**
     * Create new  Car
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExists($request)
    {
        $car = Car::withTrashed()
                            ->where([
                                ['plate_first',     $request->plate_first],
                                ['plate_second',    $request->plate_second],
                                ['plate_word',      $request->plate_second],
                            ])
                            ->first();

        if (is_null($car))
        {
            $new_car = Car::create([
                    'plate_first'       => $request->plate_first,
                    'plate_second'      => $request->plate_second,
                    'plate_word'        => $request->plate_word,
                    // 'model'             => $request->model,
                    'capacity'          => $request->capacity,
                    'chasiscode'        => $request->chasiscode,
                    'enginecode'        => $request->enginecode,
                    'car_color_id'      => $request->color_id,
                    'car_type_id'       => $request->type_id,
                    'car_model_id'      => $request->model_id,
                    'car_fuel_id'       => $request->fuel_id,
                    'car_level_id'      => $request->level_id,
                    'car_system_id'     => $request->system_id,
                    'car_plate_type_id' => $request->plate_type_id,
                    'car_plate_city_id' => $request->plate_city_id,
                    'card_id'           => $request->card_id,
                ]);

            return $new_car;
        }
        else
        {
            $car->restore();

            return $car;
        }

        return null;
    }
    /**
     * Give User
     */
    public function giveUserTo($user)
    {
        $this->users()->sync($user);
    }

    /**
     * Take User
     */
    public function takeUserFrom($user)
    {
        $this->users()->updateExistingPivot($user->id, ['deleted_at' => \Carbon\Carbon::now()]);
    }

    /**
     * Get state value
     */
    public function getStateStrAttribute()
    {
        if (! isset ($this->attributes['state']))
        {
            return static::$C_STR_ACTIVE;
        }

        return $this->attributes['state'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }

    /**
     * Update by request
     *
     * @param      <type>  $car   The car
     *
     * @return     array   ( description_of_the_return_value )
     */
    public static function updateByRequest($car)
    {
        $orginal_car = Car::find($car->id);
        $orginal_car->update([
                'card_id' => $car->card_id,
                'plate_first' => $car->plate_first,
                'plate_second' => $car->plate_second,
                'plate_word' => $car->plate_word,
                // 'model' => $car->model,
                'capacity' => $car->capacity,
                'chasiscode' => $car->chasiscode,
                'enginecode' => $car->enginecode,
                // 'state' => $request->state,
                'car_color_id' => $car->color_id,
                'car_type_id' => $car->type_id,
                'car_model_id' => $car->model_id,
                'car_fuel_id' => $car->fuel_id,
                'car_level_id' => $car->level_id,
                'car_system_id' => $car->system_id,
                'car_plate_type_id' => $car->plate_type_id,
                'car_plate_city_id' => $car->plate_city_id,
            ]);

        $relation_car = [
                'carColor',
                'carFuel',
                'carLevel',
                'carSystem',
                'carModel',
                'carType',
                'carPlateType',
                'carPlateCity',
            ];

        $orginal_car->load($relation_car)->get();

        return [
                'status' => 0,
                'car'   => $orginal_car
            ];
    }

}
