<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Schedule extends Model
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
     * Roles
     * @return [type] [description]
     */
    public function gatePlans()
    {
        return $this->belongsToMany(GatePlan::class);
    }

    /**
     * Create new Schedule
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {
        $schedule = Schedule::withTrashed()
                            ->where('index', $request->index)
                            ->where('name', $request->name)
                            ->where('begin_number', $request->start_value)
                            ->where('end_number', $request->end_value)
                            ->first();

        if (is_null($schedule))
        {
            $newSchedule = Schedule::create([
                    'index'         => $request->index,
                    'name'          => $request->name,
                    'begin_time'    => $request->begin,
                    'end_time'      => $request->end,
                    'begin_number'  => $request->start_value,
                    'end_number'    => $request->end_value,
                ]);
            return $newSchedule;
        }
        else
        {
            $schedule->restore();

            return $schedule;
        }
        return null;
    }
}
