<?php

namespace App\Http\Controllers;

use App\CarPlateType;
use Illuminate\Http\Request;
use App\Http\Requests\CarPlateTypeRequest;

class CarPlateTypeController extends Controller
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
            $plate_type = CarPlateType::paginate(Controller::C_PAGINATE_SIZE);

            return $plate_type;
         }
         return view('cars.plate_type.index');
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
    public function store(CarPlateTypeRequest $request)
    {
         if ($request->ajax())
        {
            // Check for duplicate
            $carPlateType = CarPlateType::createIfNotExist($request);

            return [
                'status' => is_null($carPlateType) ? 1 : 0,
                'carPlateType' => $carPlateType
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarPlateType  $carPlateType
     * @return \Illuminate\Http\Response
     */
    public function show(CarPlateType $carPlateType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarPlateType  $carPlateType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPlateType $carPlateType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarPlateType  $carPlateType
     * @return \Illuminate\Http\Response
     */
    public function update(CarPlateTypeRequest $request, CarPlateType $carPlateType)
    {
        if ($request->ajax())
        {
            $carPlateType->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carPlateType' => $carPlateType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarPlateType  $carPlateType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarPlateType $carPlateType)
    {
        if ($request->ajax())
        {
            $carPlateType->delete();

            return [
                'status' => 0
            ];
        }
    }
}
