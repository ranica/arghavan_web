<?php

namespace App;

use App\Permission;
use App\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
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
     * Create new Role
     *     but before create check conflicts
     * @param  Request $request
     * @return Role         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $role = Role::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($role))
        {
            $newRole = Role::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'state' => $request->state,
                ]);

            return $newRole;
        }
        else
        {
            $role->restore();

            return $role;
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

    /**
     * Give Permission
     */
    public function givePermissionTo($permission)
    {
        $this->permissions()->sync($permission);
    }

    /**
     * Get assigned permission
     * @return [type] [description]
     */
    public function permissions()
    {
        return $this->belongsToMany (\App\Permission::class);
    }

    /**
     * Get Active roles
     * @return [type] [description]
     */
    public static function activeRoles()
    {
        return Role::where('state', true);
    }
}
