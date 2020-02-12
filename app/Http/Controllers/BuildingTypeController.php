<?php

namespace App\Http\Controllers;

use App\BuildingType;
use Illuminate\Http\Request;
use App\Http\Requests\BuildingTypeRequest;

class BuildingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax())
        {
            $building_types = \App\BuildingType::paginate(Controller::C_PAGINATE_SIZE);
            return $building_types;
        }

        return view ('building_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingTypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $new_building_type = \App\BuildingType::createIfNotExist($request);

            return [
                'status' => is_null($new_building_type) ? 1 : 0,
                'building_type' => $new_building_type
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingType $buildingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingType $buildingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingTypeRequest $request, BuildingType $buildingType)
    {
         if ($request->ajax())
        {
            $buildingType->update([
                                'name' => $request->name,
                            ]);

            return [
                'status' => 0,
                'building_type' => $buildingType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BuildingType $buildingType)
    {
       if ($request->ajax())
        {
            $buildingType->delete();

            return [
                'status' => 0
            ];
        }
    }
}
