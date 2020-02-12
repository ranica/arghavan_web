<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupPermit extends Model
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
     * Relaition Group_Permit to Roles
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class);
    }

    /**
     * Create new Group Permit
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $grouppermit = GroupPermit::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($grouppermit))
        {
            $newGroupPermit = GroupPermit::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

            return $newGroupPermit;
        }
        else
        {
            $grouppermit->restore();

            return $grouppermit;
        }

        return null;
    }

    /**
     * Give Role
     */
    public function giveRoleTo($role)
    {
        $this->roles()->sync($role);
    }
}
