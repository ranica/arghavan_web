<?php

namespace App;

use App\VacationType;
use App\VacationStatus;
use App\User;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacationRequest extends Model
{
    public static $VACATION_DAILY   = 1;
    public static $VACATION_CLOCK  = 2;

    use SoftDeletes;
     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates   = [
        'deleted_at'
    ];

    protected $guarded =[
        'id'
    ];

     protected $casts = [
        'extra' => 'array'
    ];
     /**
     * List of related vacationStatus
     */
    public function vacationStatus()
    {
        return $this->belongsTo(VacationStatus::class);
    }

    /**
     * List of related vacationType
     */
    public function vacationType()
    {
        return $this->belongsTo(VacationType::class);
    }

    /**
     * Get User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create new Vacation Request
     *     but before create check conflicts
     * @param  Request $request
     * @return Vacation Request         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $vacRequest = VacationRequest::withTrashed()
                            ->where([
                                        ['user_id', $request->user_id],
                                        ['subject', $request->subject],
                                        ['vacation_type_id', $request->vacationType_id],
                                        ['begin_hour', $request->begin_hour],
                                        ['begin_date', $request->begin_date],
                                ])
                            ->first();

        if (is_null($vacRequest))
        {
            $newRequest = VacationRequest::create([
                    'user_id' => $request->user_id,
                    'subject' => $request->subject,
                    'vacation_status_id' => $request->vacationStatus_id,
                    'vacation_type_id' => $request->vacationType_id,
                    'begin_hour' => $request->begin_hour,
                    'finish_hour' => $request->finish_hour,
                    'begin_date' => $request->begin_date,
                    'finish_date'=> $request->finish_date,
                ]);

            return $newRequest;
        }
        else
        {
            $vacRequest->restore();

            return $vacRequest;
        }
        return null;
    }

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
    /**
     * Get Count Unreaded Vacation Request
     */
    public static function getVacationUnReaded()
    {

        try {
            $count = \App\VacationRequest::whereNull('seen_at')
                        ->count();
        }
        catch (\Exception $e) {
            $count = 0;
        }

        return $count;
    }
}
