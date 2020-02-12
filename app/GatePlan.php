<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GatePlan extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'deleted_at'
    ];
    /**
     * Creates if not exists.
     */
    public static function createIfNotExist($request)
    {
        $gatePlan = GatePlan::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($gatePlan))
        {
            $newGatePlan = GatePlan::create([
                    'name' => $request->name,
            ]);

            return $newGatePlan;
        }
        else
        {
            $gatePlan->restore();

            return $gatePlan;
        }

        return null;
    }

    /**
     * Give Schedule
     */
    public function giveScheduleTo($schedule)
    {
        $this->schedules()->sync($schedule);
    }

    public function takeScheduleFrom($schedule)
    {
        $this->schedules()->detach($schedule);
    }


    /**
     * Get assigned $schedule
     * @return [type] [description]
     */
    public function schedules()
    {
        return $this->belongsToMany (\App\Schedule::class);
    }
}
