<?php

namespace App;
use App\Role;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
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
     * Create new Permission
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {       
        $permission = Permission::withTrashed()
                            ->where('key', $request->key)
                            ->first();

        if (is_null($permission))
        {
            $newPermission = Permission::create([
                    'key' => $request->key,
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

            return $newPermission;
        }
        else
        {
            $permission->restore();

            return $permission;
        }

        return null;
    }

    /**
     * Roles
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
