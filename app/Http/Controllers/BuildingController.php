<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use App\Http\Requests\BuildingRequest;

class BuildingController extends Controller
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
            $buildings = Building::with('block','buildingType')
                          ->paginate(Controller::C_PAGINATE_SIZE);

            return $buildings;
        }

        return view('buildings.index');
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
    public function store(BuildingRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newBuilding = Building::createIfNotExists($request);

            $newBuilding->load('block')->get();
            $newBuilding->load('buildingType')->get();

            return [
                'status' => is_null($newBuilding) ? 1 : 0,
                'building'   => $newBuilding
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingRequest $request, Building $building)
    {
        if ($request->ajax())
        {
            $building->update([
                'name'        => $request->name,
                'block_id' => $request->block_id,
                'building_type_id' => $request->building_type_id,
                'room_count' => $request->room_count,
                'floor_count' => $request->floor_count,
            ]);

            $building->load('block')->get();
            $building->load('buildingType')->get();

            return [
                'status' => 0,
                'building'   => $building
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Building $building)
    {
        if ($request->ajax())
        {
            $building->delete();

            return [
                'status' => 0
            ];
        }
    }
}
