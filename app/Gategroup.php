<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gategroup extends Model
{
	use SoftDeletes;
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
     * Get assigned Gatedevice
     */
    public function gatedevices()
    {
        return $this->belongsToMany(\App\Gatedevice::class);
    }
    /*
     * Get assign user
     */

    public function users()
    {
        return $this->belongsToMany (\App\User::class);
    }

    /**
     * Give Gate device
     */
    public function giveGatedeviceTo($gatedevice)
    {
        $this->gatedevices()->sync($gatedevice);
    }

     /**
     * Create new Gategroup
     *     but before create check conflicts
     * @param  Request $request
     * @return Gategroup         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $gategroup = \App\Gategroup::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($gategroup))
        {
            $newGategroup = \App\Gategroup::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

            return $newGategroup;
        }
        else {
            $gategroup->restore();

            return $gategroup;
        }
        return null;
    }

  
}
