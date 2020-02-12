<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Report extends Model
{
    public static $GATE_INPUT   = 1; // تردد در جهت ورود
    public static $GATE_OUTPUT   = 2; // تردد در جهت   خروج
    public static $GATE_TARFFIC_DONE  = 1; // تردد لنجلم شد
    public static $GATE_PASS_CAR  = 4; // تردد با استفاده از خودرو
    public static $LIMIT = 50;

    protected $appends = [
        'date'
    ];

    /**
     * Set created_at to diffForHumans
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getCreatedAtAttribute($date)
    {
        Carbon::setLocale('fa');
        return Carbon::parse($date)->diffForHumans();
    }

}
