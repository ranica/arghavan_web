<?php

namespace App;
use App\People;
use App\User;
use App\Card;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    
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
     * List of related Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * List of related Peoples
     */
    public function peoples()
    {
        return $this->hasMany(People::class);
    }

    /**
     * List of related Card
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Create new Group
     *     but before create check conflicts
     * @param  Request $request
     * @return Group         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $group = Group::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($group))
        {
            $newGroup = Group::create([
                    'name' => $request->name,
                ]);

            return $newGroup;
        }
        else
        {
            $group->restore();

            return $group;
        }

        return null;
    }
}
