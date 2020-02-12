<?php

namespace App\Http\Controllers;

use App\CarFuel;
use App\Http\Requests\CarFuelRequest;
use Illuminate\Http\Request;

class CarFuelController extends Controller
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
            $car_fuel = CarFuel::paginate(Controller::C_PAGINATE_SIZE);

            return $car_fuel;
         }
         return view('car_fuel.index');
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
    public function store(CarFuelRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carFuel = CarFuel::createIfNotExist($request);

            return [
                'status' => is_null($carFuel) ? 1 : 0,
                'carFuel' => $carFuel
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarFuel  $CarFuel
     * @return \Illuminate\Http\Response
     */
    public function show(CarFuel $carFuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarFuel  $CarFuel
     * @return \Illuminate\Http\Response
     */
    public function edit(CarFuel $carFuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarFuel  $CarFuel
     * @return \Illuminate\Http\Response
     */
    public function update(CarFuelRequest $request, CarFuel $carFuel)
    {
        if ($request->ajax())
        {
            $carFuel->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carFuel' => $carFuel
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarFuel  $CarFuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarFuel $carFuel)
    {
        if ($request->ajax())
        {
            $carFuel->delete();

            return [
                'status' => 0
            ];
        }
    }
}
