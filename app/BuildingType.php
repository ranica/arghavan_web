<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuildingType extends Model
{
     use SoftDeletes;
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
     * Creates if not exist.
     */
    public static function
    createIfNotExist($request)
    {
        $builing_type = BuildingType::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($builing_type))
        {
            $new_building_type = BuildingType::create([
                    'name' => $request->name,
                ]);

            return $new_building_type;
        }
        else
        {
            $builing_type->restore();

            return $builing_type;
        }

        return null;
    }
}
