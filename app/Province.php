<?php

namespace App;
use App\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    /**
     * [$guarded description]
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
     * List of related Cities
     * @return [type] [description]
     */
    public function cities()
    {
    	return $this->hasMany(City::class);
    }


    /**
     * Create new province
     * 	but before create check conflicts
     * @param  Request $request
     * @return Province         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $province = Province::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($province))
        {
            $newProvince = Province::create(
                [
                    'name' => $request->name,
                ]
            );

            return $newProvince;
        }
        else
        {
            $province->restore();

            return $province;
        }

        return null;

    }
}
