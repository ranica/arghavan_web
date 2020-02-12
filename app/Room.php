<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
     use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
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

    public function building()
    {
        return $this->belongsTo(\App\Building::class);
    }
    /**
     * Get assigned Group permit
     */
    public function materials()
    {
        return $this->belongsToMany(\App\Material::class);
    }
    /**
     * Creates if not exists.
     *
     * @param      <type>  $request  The request
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function createIfNotExists($request)
    {
        $room = Room::withTrashed()
                            ->where([
                                ['number', $request->number],
                                ['building_id', $request->building_id],
                                ['gender_id', $request->gender_id],
                            ])
                            ->first();

        if (is_null($room))
        {
            $newRoom = Room::create([
                    'number' => $request->number,
                    'capacity' => $request->capacity,
                    'floor' => $request->floor,
                    'building_id' => $request->building_id,
                    'gender_id' => $request->gender_id,
                ]);

            return $newRoom;
        }
        else
        {
            $room->restore();

            return $room;
        }

        return null;
    }

     /**
     * Give Material
     */
    public function giveMaterialsTo($material)
    {
        $this->materials()->sync($material);
    }

}
