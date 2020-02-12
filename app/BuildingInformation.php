<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BuildingInformation extends Model
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
     * Get Building
     */
    public function building()
    {
        return $this->belongsTo(\App\Building::class);
    }

     /**
     * Get Term
     */
    public function degree()
    {
        return $this->belongsTo(\App\Degree::class);
    }
    /**
     * @return Get Term
     */
    public function term()
    {
        return $this->belongsTo(\App\Term::class);
    }

    /**
     * @return Get Gate Plan
     */
    public function gatePlan()
    {
        return $this->belongsTo(\App\GatePlan::class);
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
        $buildingInformation = BuildingInformation::withTrashed()
                                ->where([
                                            ['building_id', $request->building_id],
                                            ['term_id', $request->term_id],
                                            ['degree_id', $request->degree_id],
                                        ])
                                ->first();

        if (is_null($buildingInformation))
        {
            $newBuildingInformation = BuildingInformation::create([
                    'degree_id' => $request->degree_id,
                    'building_id' => $request->building_id,
                    'term_id' => $request->term_id,
                    'gate_plan_id'=> $request->gatePlan_id,
                ]);

            return $newBuildingInformation;
        }
        else
        {
            $buildingInformation->restore();

            return $buildingInformation;
        }

        return null;
    }
}
