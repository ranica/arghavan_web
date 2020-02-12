<?php

namespace App;
use App\Gatedevice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
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
     * Get Gate Device
     * @return [type] [description]
     */
    public function gatedevices()
    {
        return $this->hasMany(Gatedevice::class);
    }

    /**
     * Create new Zone
     *     but before create check conflicts
     * @param  Request $request
     * @return Zone         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
       $count = Zone::where([
                ['name', $request->name]                
            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new field
            $newZone = Zone::create([
                'name' => $request->name
            ]);

            return $newZone;
        }

        return null;
    }
}
