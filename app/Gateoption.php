<?php

namespace App;
use App\Gatezone;
use App\Gatedevice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gateoption extends Model
{

    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

     protected $appends = [
        'emergencyStr'
    ];
    /**
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
	 * Get GateZone Woman
	 */
    public function gatezoneW()
    {
    	return $this->belongsTo(Gatezone::class, 'genzonew_id', 'id');
    }

	/**
	 * Get GateZone Man
	 */
    public function gatezoneM()
    {
    	return $this->belongsTo(Gatezone::class, 'genzonem_id', 'id');
    }

    /**
     * Create new GateOption
     *     but before create check conflicts
     * @param  Request $request
     * @return GateOption         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $gateoption = Gateoption::withTrashed()
                            ->where([
                                ['startDate', $request->startDate],
                                ['endDate', $request->endDate],
                                ['port', $request->port],
                                ['emergency', $request->emergency],
                                ['genzonew_id', $request->genzonew_id],
                                ['genzonem_id', $request->genzonem_id],
                                ])
                            ->first();

        if (is_null($gateoption))
        {
            $newGateoption = Gateoption::create([
                'startDate'   => $request->startDate,
                'endDate'     => $request->endDate,
                'port'        => $request->port,
                'emergency'   => $request->emergency,
                'genzonew_id' => $request->genzonew_id,
                'genzonem_id' => $request->genzonem_id,
            ]);

            return $newGateoption;
        }
        else
        {
            $gateoption->restore();

            return $gateoption;
        }
        return null;

    }

      /**
     * Get net state value
     */
    public function getEmergencyStrAttribute()
    {
        if (! isset ($this->attributes['emergency']))
        {
            return static::$C_STR_ACTIVE;
        }
        return $this->attributes['emergency'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }
     /**
     * Get assigned gatedevice
     */
    public function gatedevices()
    {
        return $this->belongsToMany(Gatedevice::class);
    }
     /**
     * Give Gate device
     */
    public function giveGatedeviceTo($gatedevice)
    {
        $this->gatedevices()->sync($gatedevice);
    }

}
