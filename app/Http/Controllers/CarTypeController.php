<?php

namespace App\Http\Controllers;

use App\CarType;
use Illuminate\Http\Request;
use App\Http\Requests\CarTypeRequest;

class CarTypeController extends Controller
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
            $car_type = CarType::paginate(Controller::C_PAGINATE_SIZE);

            return $car_type;
         }
         return view('car_type.index');
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
    public function store(CarTypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carType = CarType::createIfNotExist($request);

            return [
                'status' => is_null($carType) ? 1 : 0,
                'carType' => $carType
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarType  $CarType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarType  $CarType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarType  $CarType
     * @return \Illuminate\Http\Response
     */
    public function update(CarTypeRequest $request, CarType $carType)
    {
        if ($request->ajax())
        {
            $carType->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carType' => $carType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarType  $CarType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarType $carType)
    {
        if ($request->ajax())
        {
            $carType->delete();

            return [
                'status' => 0
            ];
        }
    }
}
