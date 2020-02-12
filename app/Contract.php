<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contract extends Model
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
     * Create new Contract
     *     but before create check conflicts
     * @param  Request $request
     * @return Contract         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $contract = Contract::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($contract))
        {
            $newContract = Contract::create([
                    'name' => $request->name,
                ]);

            return $newContract;
        }
        else
        {
            $contract>restore();

            return $contract;
        }

        return null;
    }
}
