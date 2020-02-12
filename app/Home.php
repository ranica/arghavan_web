<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

\Carbon\Carbon::setToStringFormat('d-m-Y');
class Home extends Model
{
    protected $dates = [
        'from_date',
    ];

    protected $appends = [
        'pictureUrl',
        'pictureThumbUrl',
    ];

    /**
     * Get picture Url
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function getPictureUrl($value)
    {
        if (is_null($value) || ($value == ''))
        {
            return asset("images/default-avatar.png");
        }

        return \Storage::url($value);
    }

    /**
     * Get picture-thumb Url
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function getPictureThumbUrl($value)
    {
        if (is_null($value) || ($value == ''))
        {
            return asset("images/default-avatar.png");
        }

        $info = pathinfo ($value) ;
        $ext = $info['extension'];
        $value = str_replace(".{$ext}", "-t.{$ext}", $value);

        return \Storage::url($value);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureUrlAttribute()
    {
        return static::getPictureUrl($this->picture);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureThumbUrlAttribute()
    {
        return static::getPictureThumbUrl($this->picture);
    }


    public function getFromDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public static function todayDashboard()
    {
        return miladiToPersianDate(\Carbon\Carbon::now()->format('Y-m-d'));
    }
}
