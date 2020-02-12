<?php

namespace App\Http\Controllers;

use App\CarSystem;
use Illuminate\Http\Request;
use App\Http\Requests\CarSystemRequest;

class CarSystemController extends Controller
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
            $car_system = CarSystem::paginate(Controller::C_PAGINATE_SIZE);

            return $car_system;
         }
         return view('car_system.index');
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
    public function store(CarSystemRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carSystem = CarSystem::createIfNotExist($request);

            return [
                'status' => is_null($carSystem) ? 1 : 0,
                'carSystem' => $carSystem
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarSystem  $CarSystem
     * @return \Illuminate\Http\Response
     */
    public function show(CarSystem $carSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarSystem  $CarSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(CarSystem $carSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarSystem  $CarSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarSystem $carSystem)
    {
        if ($request->ajax())
        {
            $carSystem->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carSystem' => $carSystem
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarSystem  $CarSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarSystem $carSystem)
    {
        if ($request->ajax())
        {
            $carSystem->delete();

            return [
                'status' => 0
            ];
        }
    }
}
