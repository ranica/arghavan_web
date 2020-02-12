<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Sms extends Model
{
    use SoftDeletes;

    public static $MESSAGE_ACTIVE  = 1;

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
     * Log sms send status into database
     * @param [type] $result   [description]
     * @param [type] $messages [description]
     * @param [type] $numbers  [description]
     * @param [type] $user_id  [description]
     */
    public static function DBlog ($result, $messages, $numbers, $user_id)
    {
        $lineNumber = config('smsir.line-number');

        $numbers = (array)$numbers;
        $messages = (array)$messages;

        if (count($messages) === 1)
        {
            foreach ($numbers as $number )
            {
                Sms::create( [
                    'user_id'  => $user_id,
                    'message'  => $messages[0],
                    'from'     => $lineNumber,
                    'to'       => $number,
                    'status'   => $result['IsSuccessful'],
                    'response' => $result['Message'],
                ]);
            }
        }
        else
        {
            foreach ( array_combine( $messages, $numbers ) as $message => $number )
            {
                Sms::create( [
                    'response' => $result['Message'],
                    'message'  => $message,
                    'status'   => $result['IsSuccessful'],
                    'from'     => $lineNumber,
                    'to'       => $number,
                    'user_id'  => $user_id,
                ]);
            }
        }
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
     * Query state sms
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeStatus($query)
    {
        // active status
        $query->where('status', \App\Sms::$MESSAGE_ACTIVE);
    }

}
