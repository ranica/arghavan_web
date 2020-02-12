<?php

namespace App\Http\Controllers;

use App\CarLevel;
use App\Http\Requests\CarLevelRequest;
use Illuminate\Http\Request;

class CarLevelController extends Controller
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
            $car_level = CarLevel::paginate(Controller::C_PAGINATE_SIZE);

            return $car_level;
         }
         return view('car_level.index');
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
    public function store(CarLevelRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carLevel = CarLevel::createIfNotExist($request);

            return [
                'status' => is_null($carLevel) ? 1 : 0,
                'carLevel' => $carLevel
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarLevel  $CarLevel
     * @return \Illuminate\Http\Response
     */
    public function show(CarLevel $carLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarLevel  $CarLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(CarLevel $carLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarLevel  $CarLevel
     * @return \Illuminate\Http\Response
     */
    public function update(CarLevelRequest $request, CarLevel $carLevel)
    {
        if ($request->ajax())
        {
            $carLevel->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carLevel' => $carLevel
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarLevel  $CarLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarLevel $carLevel)
    {
        if ($request->ajax())
        {
            $carLevel->delete();

            return [
                'status' => 0
            ];
        }
    }
}
