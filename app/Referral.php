<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referral extends Model
{
    use SoftDeletes;
    public static $C_REFERRAL_PART_ONE = "درخواست های مراجعه";
    public static $C_REFERRAL_PART_TWO = "مراجعه های حضوری";


     protected $appends = [
        'pictureUrl',
        'pictureThumbUrl',
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
     * @return mixed
     */
    public function gender()
    {
        return $this->belongsTo(\App\Gender::class);
    }

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(\App\Department::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return mixed
     */
    public function warranty()
    {
        return $this->belongsTo(\App\Warranty::class);
    }

    /**
     * @return mixed
     */
    public function referralType()
    {
        return $this->belongsTo(\App\ReferralType::class);
    }

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

        $value = str_replace('.jpeg', '-t.jpeg', $value);

        return \Storage::url($value);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureUrlAttribute(){
        return static::getPictureUrl($this->picture);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureThumbUrlAttribute(){
        return static::getPictureThumbUrl($this->picture);
    }


    /**
     * Create new field
     *     but before create check conflicts
     * @param  Request $request
     * @return Field         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $referral = Referral::withTrashed()
                            ->where([
                                    ['nationalId', $request->nationalId]
                                ])
                            ->first();

        if (is_null($referral))
        {
            $newReferral = Referral::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'nationalId' => $request->nationalId,
                    'mobile' => $request->mobile,
                    'organization' => $request->organization,
                    'referral_type_id' => $request->referral_type_id,
                    'gender_id' => $request->gender_id,
                    'user_id' => $request->user_id,
                    'department_id' => $request->department_id,
                    'warranty_id' => $request->warranty_id,
                ]);

            return $newReferral;
        }
        else
        {
            $referral->restore();

            return $referral;
        }
        return null;
    }
}
