<?php

namespace App\Http\Controllers;

use App\CarPlateCity;
use Illuminate\Http\Request;

class CarPlateCityController extends Controller
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
            $plateCity = CarPlateCity::all();

            return $plateCity;
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarPlateCity  $carPlateCity
     * @return \Illuminate\Http\Response
     */
    public function show(CarPlateCity $carPlateCity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarPlateCity  $carPlateCity
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPlateCity $carPlateCity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarPlateCity  $carPlateCity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarPlateCity $carPlateCity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarPlateCity  $carPlateCity
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarPlateCity $carPlateCity)
    {
        //
    }
}
