<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralType extends Model
{
    use SoftDeletes;

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
     * Create new ReferralType
     *     but before create check conflicts
     * @param  Request $request
     * @return ReferralType         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $referralType = ReferralType::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($referralType))
        {
            $newReferralType = ReferralType::create([
                    'name' => $request->name,
                ]);

            return $newReferralType;
        }
        else
        {
            $referralType->restore();

            return $referralType;
        }

        return null;
    }
}
