<?php

namespace App\Http\Controllers;

use App\CarSite;
use Illuminate\Http\Request;
use App\Http\Requests\CarSiteRequest;

class CarSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->ajax())
         {
            $car_site = CarSite::paginate(Controller::C_PAGINATE_SIZE);

            return $car_site;
         }
         return view('car_site.index');
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
    public function store(CarSiteRequest $request)
      {
        if ($request->ajax())
        {
            // Check for duplicate
            $carSite = CarSite::createIfNotExists($request);

            return [
                'status' => is_null($carSite) ? 1 : 0,
                'carSite' => $carSite
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarSite  $carSite
     * @return \Illuminate\Http\Response
     */
    public function show(CarSite $carSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarSite  $carSite
     * @return \Illuminate\Http\Response
     */
    public function edit(CarSite $carSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarSite  $carSite
     * @return \Illuminate\Http\Response
     */
    public function update(CarSiteRequest $request, CarSite $carSite)
    {
        if ($request->ajax())
        {
            $carSite->update([
                    'name' => $request->name ,
                    'capacity' => $request->capacity ,
                    'state' => $request->state ,
                ]);

            return [
                'status' => 0,
                'carSite' => $carSite
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarSite  $carSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarSite $carSite)
      {
        if ($request->ajax())
        {
            $carSite->delete();

            return [
                'status' => 0
            ];
        }
    }
}
