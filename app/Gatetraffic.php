<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Gatedevice;
use App\Gatepass;
use App\Gateoperator;

class Gatetraffic extends Model
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
	 * Get User
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get Gate_Device
	 */
    public function gatedevice()
	{
		return $this->belongsTo(Gatedevice::class);
	}

	/**
	 * Get Gate Pass
	 */
	public function gatepass()
	{
		return $this->belongsTo(Gatepass::class);
	}

	/**
	 * Get Gate Direct
	 */
	public function gatedirect()
	{
		return $this->belongsTo(Gatedirect::class);
	}

	/**
	 * Get Gate Message
	 */
	public function gatemessage()
	{
		return $this->belongsTo(Gatemessage::class);
	}

    /**
     * Get Gate Operator
     */
    public function gateoperator()
    {
        return $this->belongsTo(Gateoperator::class);
    }


    /**
     * Query all input traffics
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeInputTraffic($query)
    {
        // Input Traffic
        $query->where('gatetraffics.gatedirect_id', '=', \App\Report::$GATE_INPUT);
    }

    /**
     * Query all output traffics
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeOutputTraffic($query)
    {
        // Output Traffic
        $query->where('gatetraffics.gatedirect_id', '=', \App\Report::$GATE_OUTPUT);
    }

    /**
     * Query all done traffics
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeDoneTraffic($query)
    {
        // Done Traffic
        $query->where('gatetraffics.gatemessage_id', '=', \App\Report::$GATE_TARFFIC_DONE);
    }
     /**
     * Query all Car traffics
     */
    public function scopePassDontCarTraffic($query)
    {
        // Dont Pass Car Traffic
        $query->where('gatetraffics.gatepass_id', '<>', \App\Report::$GATE_PASS_CAR);
    }

    /**
     * Query all Car traffics
     */
    public function scopePassCarTraffic($query)
    {
        // Pass Car Traffic
        $query->where('gatetraffics.gatepass_id', '=', \App\Report::$GATE_PASS_CAR);
    }

    /**
     * Create new gate traffic
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $gatetraffic = Gatetraffic::withTrashed()
                            ->where([
		                            	['user_id', $request->user_id],
		                            	['gatedate', $request->gatedate],
		                            	['gatedirect_id', $request->gatedirect_id]
                            ])
                            ->first();

        if (is_null($gatetraffic))
        {
            $newGateTraffic = Gatetraffic::create([
                    'user_id' => $request->user_id,
                    'gatedirect_id' => $request->gatedirect_id,
                    'gatemessage_id' => $request->gatemessage_id,
                    'gatedevice_id' => $request->gatedevice_id,
                    'gatepass_id' => $request->gatepass_id,
                    'gatedate' => $request->gatedate,
                    'gateoperator_id' => $request->gateoperator_id,
                ]);

            return $newGateTraffic;
        }
        else
        {
            $gatetraffic->restore();

            return $gatetraffic;
        }

        return null;
    }
}
