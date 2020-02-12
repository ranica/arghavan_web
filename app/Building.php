<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;

    protected $guarded =[
        'id'
    ];
    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get Block
     */
    public function block()
    {
        return $this->belongsTo(Block::class);
    }
    /**
     * Get Building type
     */
    public function buildingType()
    {
        return $this->belongsTo(BuildingType::class);
    }
    /**
     * Creates if not exists.
     */
     public static function createIfNotExists($request)
    {
        $building = Building::withTrashed()
                                ->where([
                                            ['name', $request->name],
                                            ['block_id', $request->block_id],
                                        ])
                                ->first();

        if (is_null($building))
        {
            $newBuilding = Building::create([
                    'name' => $request->name,
                    'room_count' => $request->room_count,
                    'floor_count' => $request->floor_count,
                    'block_id'=> $request->block_id,
                    'building_type_id' => $request->building_type_id,
                ]);

            return $newBuilding;
        }
        else
        {
            $building->restore();

            return $building;
        }

        return null;
    }

}
