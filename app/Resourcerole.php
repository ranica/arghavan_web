<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resourcerole extends Model
{
    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

     /**
     * @var array
     */
    protected $appends = [
        'stateStr'
    ];   

   /**
	 * @var [type]
	 */
    public $guarded = [
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
     * @return resource
     */
    public function resource()
    {
    	return $this->belongsTo(Resource::class);
    }

    /**
     * @return role
     */
    public function role()
    {
    	return $this->belongsTo(Role::class);
    }

    /**
     * Create new Resourcerole
     *     but before create check conflicts
     * @param  Request $request
     * @return Resourcerole         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $count = Resourcerole::where([
                ['state', $request->state],
                ['resource_id', $request->resource_id],
                ['role_id', $request->role_id],
            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new Resourcerole
            $newResourcerole = Resourcerole::create([
                'state'       => $request->state,
                'resource_id' => $request->resource_id,
                'role_id'     => $request->role_id,
            ]);

            return $newResourcerole;
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
