<?php

namespace App\Http\Controllers;

use App\CarColor;
use App\Http\Requests\CarColorRequest;
use Illuminate\Http\Request;

class CarColorController extends Controller
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
            $car_color = CarColor::paginate(Controller::C_PAGINATE_SIZE);

            return $car_color;
         }
         return view('car_color.index');
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
    public function store(CarColorRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carColor = CarColor::createIfNotExist($request);

            return [
                'status' => is_null($carColor) ? 1 : 0,
                'carColor' => $carColor
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarColor  $CarColor
     * @return \Illuminate\Http\Response
     */
    public function show(CarColor $carColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarColor  $CarColor
     * @return \Illuminate\Http\Response
     */
    public function edit(CarColor $carColor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarColor  $CarColor
     * @return \Illuminate\Http\Response
     */
    public function update(CarColorRequest $request, CarColor $carColor)
    {
        if ($request->ajax())
        {
            $carColor->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carColor' => $carColor
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarColor  $CarColor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarColor $carColor)
    {
        if ($request->ajax())
        {
            $carColor->delete();

            return [
                'status' => 0
            ];
        }
    }
}
