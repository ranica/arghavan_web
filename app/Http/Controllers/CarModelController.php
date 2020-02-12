<?php

namespace App\Http\Controllers;

use App\CarModel;
use Illuminate\Http\Request;
use App\Http\Requests\CarModelRequest;


class CarModelController extends Controller
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
            $car_model = CarModel::paginate(Controller::C_PAGINATE_SIZE);

            return $car_model;
         }
         return view('car_model.index');
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
    public function store(CarModelRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $carModel = CarModel::createIfNotExist($request);

            return [
                'status' => is_null($carModel) ? 1 : 0,
                'carModel' => $carModel
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarModel  $CarModel
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarModel  $CarModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $carModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarModel  $CarModel
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelRequest $request, CarModel $carModel)
    {
        if ($request->ajax())
        {
            $carModel->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'carModel' => $carModel
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarModel  $CarModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarModel $carModel)
    {
        if ($request->ajax())
        {
            $carModel->delete();

            return [
                'status' => 0
            ];
        }
    }
}
