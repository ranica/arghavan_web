<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
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
     * Create new Resource
     *     but before create check conflicts
     * @param  Request $request
     * @return Resource         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
       $count = Resource::where([
                ['name', $request->name],
                ['state', $request->state],
            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new field
            $newResource = Resource::create([
                'name'  => $request->name,
                'state' => $request->state
            ]);

            return $newResource;
        }

        return null;
    }

    /**
     * Get state value
     */
    public function getStateStrAttribute()
    {
        return $this->attributes['state'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }
}
