<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactType extends Model
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
     *
     * @param      <type>  $request  The request
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function createIfNotExists($request)
    {
        $contactType = ContactType::withTrashed()
                            ->where('type', $request->type)
                            ->first();

        if (is_null($contactType))
        {
            $newContactType = ContactType::create([
                    'type' => $request->type,
                ]);

            return $newContactType;
        }
        else
        {
            $contactType->restore();

            return $contactType;
        }

        return null;
    }
}
