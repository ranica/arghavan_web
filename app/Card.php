<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

     public static $CARD_TYPE_STAFF = 1;
    public static $CARD_TYPE_STUDENT   = 2;
    public static $CARD_TYPE_TEACHER  = 3;
    public static $CARD_TYPE_CAR  = 4;

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
     * @var array
     */
    protected $appends = [
        'stateStr'
    ];

    /*
    Get User
     */
    public function users()
    {
    	// return $this->belongsToMany('\App\User')
     //                ->withPivot('user_id',  'card_id');
        return $this->belongsToMany(\App\User::class);
    }
    /*
    Get Card Type
     */
    public function cardtype()
    {
    	return $this->belongsTo(\App\Cardtype::class);
    }
    /*
    Get Group
     */

    public function group()
    {
    	return $this->belongsTo(\App\Group::class);
    }

     /**
     * Get assigned Gatedevice
     * @return [type] [description]
     */
    public function gatedevices()
    {
        return $this->belongsToMany (\App\Gatedevice::class);
    }

    public function scopeViwTest($query)
    {
        return $query->from('viwTest');
    }

    /**
     * Give User
     */
    public function giveUserTo($user)
    {
        $this->users()->sync($user);
    }

     /**
     * Give Gate device
     */
    public function giveGatedeviceTo($gatedevice)
    {
        $this->gatedevices()->sync($gatedevice);
    }

    public function takeUserFrom($user)
    {
         // $this->users()->detach($user);
        $this->users()->updateExistingPivot($user->id, ['deleted_at' => \Carbon\Carbon::now()]);
    }

    /**
     * Create new card
     *     but before create check conflicts
     * @param  Request $request
     * @return card         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $card = Card::withTrashed()
                        ->where([
                                    ['cdn', $request->cdn],
                                ])
                        ->first();

        if (is_null($card))
        {
            $newCard = Card::create([
                    'cdn'           => $request->cdn,
                    'state'         => $request->state,
                    'startDate'     => $request->startDate,
                    'endDate'       => $request->endDate,
                    'cardtype_id'   => $request->cardtype_id,
                ]);

            return $newCard;
        }
        else {
            $card->restore();

            return $card;
        }

        return null;
    }

    /**
     * Update card by Request
     */
    public static function updateByRequest($card)
    {
        $orginal_card = Card::find($card->id);

        $orginal_card->update([
                'cdn'       => $card->cdn,
                'state'     => $card->state,
                'startDate' => $card->startDate,
                'endDate'   => $card->endDate,
                'cardtype_id'   => $card->cardtype_id,
            ]);

        $relation_card = [
                'cardtype',
                'users.people',
                'users.group'
            ];

        $orginal_card->load($relation_card)->get();

        return [
                'status' => 0,
                'card'   => $orginal_card
            ];
    }

    /**
     * Get state value
     */
    public function getStateStrAttribute()
    {
        if (! isset ($this->attributes['state']))
        {
            return static::$C_STR_ACTIVE;
        }

        return $this->attributes['state'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }

}
