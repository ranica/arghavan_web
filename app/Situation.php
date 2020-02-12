<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Situation extends Model
{
    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";
    use SoftDeletes;

    /**
     * @var array
     */
    protected $appends = [
        'stateStr'
    ];

	/**
	 * 
	 * @var array
	 */
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
     * List of related Peoples
     */
    public function peoples()
    {
        return $this->hasMany(People::class);
    }

    /**
     * Create new Situation
     *     but before create check conflicts
     * @param  Request $request
     * @return Situation         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $situation = Situation::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($situation))
        {
            $newSituation = Situation::create([
                    'name' => $request->name,
                ]);

            return $newSituation;
        }
        else
        {
            $situation->restore();

            return $situation;
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
