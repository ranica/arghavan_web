<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cardtype extends Model
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
     * @return Get Card
     */
    public function card()
    {
        return $this->hasOne(\App\Card::class);
    }

    /**
     * Create new CardType
     *     but before create check conflicts
     * @param  Request $request
     * @return CardType         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $cardtype = Cardtype::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($cardtype))
        {
            $newCardtype = Cardtype::create([
                    'name' => $request->name,
                ]);

            return $newCardtype;
        }
        else
        {
            $cardtype->restore();

            return $cardtype;
        }

        return null;
    }
}
