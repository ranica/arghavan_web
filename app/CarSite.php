<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarSite extends Model
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
    /**
     * Create new car_site
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExists($request)
    {
        $car_site = CarSite::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($car_site))
        {
            $new_car_site = CarSite::create([
                    'name' => $request->name,
                    'capacity' => $request->capacity,
                    'state' => $request->state,
                ]);

            return $new_car_site;
        }
        else
        {
            $car_site->restore();

            return $car_site;
        }

        return null;
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
}
