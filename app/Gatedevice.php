<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gatedevice extends Model
{
    use SoftDeletes;

	public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";
    public static $DEVICE_ACTIVE  = 1;
    public static $DEVICE_TYPE  = 0;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Check for existing Attribute
     * @param  [type]  $attr [description]
     * @return boolean       [description]
     */
    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    /**
     * @var array
     */
    protected $appends = [
        'stateStr',
        'netStateStr'
    ];

    /**
     * @var array
     */
    protected $guarded =[
    	'id'
    ];
    /**
     * Get Gate Gender
     */

    public function gategender()
    {
    	return $this->belongsTo(\App\Gategender::class);
    }

    /**
     * Get Gate Gender
     */

    public function gatepass()
    {
        return $this->belongsTo(\App\Gatepass::class);
    }

    /**
     * Get Gate Direction
     */
    public function gatedirect()
    {
    	return $this->belongsTo(\App\Gatedirect::class);
    }

    public function cards()
    {
        return $this->belongsToMany(\App\Card::class);
    }

    /**
     * Get Zone
     */
    public function zone()
    {
    	return $this->belongsTo(\App\Zone::class);
    }
    /*
     * Get device type
     */

    public function deviceType()
    {
        return $this->belongsTo(\App\DeviceType::class);
    }



     public function fingerprintDevices()
    {
        return $this->belongsToMany(\App\FpDevice::class);
    }

     /**
     * Get Gate Tarffic
     */
    public function gatetraffics()
    {
        return $this->hasMany(\App\GateTraffic::class);
    }

    /**
     * @brief       Get assign gategroup
     */
    public function gategroups()
    {
        return $this->belongsToMany(\App\Gategroup::class);
    }
    /**
     * Get state value
     */
    public function getStateStrAttribute()
    {
        if (! $this->hasAttribute('state'))
        {
            return static::$C_STR_DEACTIVE;
        }

        return $this->attributes['state'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }

    /**
     * Get Network State value
     * @return [type] [description]
     */
    public function getNetStateStrAttribute()
    {
        if (! $this->hasAttribute('netState'))
        {
            return static::$C_STR_DEACTIVE;
        }

        return $this->attributes['netState'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }

    /**
     * Create new Gatedevice
     *     but before create check conflicts
     * @param  Request $request
     * @return Gatedevice         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $gatedevice = Gatedevice::withTrashed()
                            ->where([
                                        ['name', $request->name],
                                        ['ip', $request->ip],
                                        ['state', $request->state],
                                        ['timeserver', $request->timeserver],
                                        ['timepass', $request->timepass],
                                        ['gategender_id', $request->gategender_id],
                                        ['gatepass_id', $request->gatepass_id],
                                        ['gatedirect_id', $request->gatedirect_id],
                                        ['zone_id', $request->zone_id],
                                        ['type', $request->type],
                                    ])
                            ->first();

        if (is_null($gatedevice))
        {
            $newGatedevice = Gatedevice::create([
                        'name'          => $request->name,
                        'ip'            => $request->ip,
                        'state'         => $request->state,
                        'timeserver'    => $request->timeserver,
                        'timepass'      => $request->timepass,
                        'gategender_id' => $request->gategender_id,
                        'gatepass_id'   => $request->gatepass_id,
                        'gatedirect_id' => $request->gatedirect_id,
                        'zone_id'       => $request->zone_id,
                        'type'          => $request->type,
                        'device_type_id' => $request->device_type_id,

                    ]);

            return $newGatedevice;
        }
        else
        {
            $gatedevice->restore();

            return $gatedevice;
        }

        return null;
    }

     /**
     * Query all active devices
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeNetworkStatus($query)
    {
        // Active Network status
        $query->where('netState', '=', \App\Gatedevice::$DEVICE_ACTIVE)
              ->where('type', '=', \App\Gatedevice::$DEVICE_TYPE);
    }

     public function giveFingerprintDeviceTo($fingerprintdevice)
    {
        $this->fingerprintDevices()->sync($fingerprintdevice);
    }
}
