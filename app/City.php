<?php

namespace App;
use App\Province;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $guarded =[
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
     * Get Province
     */
    public function province()
    {
    	return $this->belongsTo(Province::class);
    }

    // /**
    //  * Get People
    //  */
    // public function peoples()
    // {
    //     return $this->hasMany(People::class);
    // }

     /**
     * Create new city
     *     but before create check conflicts
     * @param  Request $request
     * @return City         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $city = City::withTrashed()
                                ->where([
                                            ['name', $request->name],
                                            ['province_id', $request->province_id]
                                        ])
                                ->first();

        if (is_null($city))
        {
            $newCity = City::create([
                    'name' => $request->name,
                    'province_id'   => $request->province_id
                ]);

            return $newCity;
        }
        else
        {
            $city->restore();

            return $city;
        }

        return null;



        // $count = City::where([
        //         ['name', $request->name],
        //         ['province_id', $request->province_id],
               
        //     ])
        //     ->get()
        //     ->count();

        // if (0 == $count)
        // {
        //     // Create new city
        //     $newCity = City::create([
        //         'name'          => $request->name,
        //         'province_id' 	=> $request->province_id
        //     ]);

        //     return $newCity;
        // }

        // return null;
    }
}
