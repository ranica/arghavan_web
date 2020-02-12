<?php

namespace App\Http\Controllers;

use App\Zone;
use App\Http\Requests\ZoneRequest;
use Illuminate\Http\Request;

class ZoneController extends Controller
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
            $zone = Zone::paginate(Controller::C_PAGINATE_SIZE);           

            return $zone;
        }

        return view('zones.index');
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
    public function store(ZoneRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newZone = Zone::createIfNotExists($request);
          

            return [
                'status' => is_null($newZone) ? 1 : 0,
                'zone'  => $newZone
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
        if ($request->ajax())
        {            
            $zone->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'zone' => $zone
            ];
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Zone $zone)
    {
        if ($request->ajax())
        {
            $zone->delete();
            
            return [
                'status' => 0
            ];
        }  
    }
}
