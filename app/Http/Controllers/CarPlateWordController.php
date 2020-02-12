<?php

namespace App\Http\Controllers;

use App\CarPlateWord;
use Illuminate\Http\Request;

class CarPlateWordController extends Controller
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
            $plateWord = CarPlateWord::all();

            return $plateWord;
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
     * @param  \App\CarPlateWord  $carPlateWord
     * @return \Illuminate\Http\Response
     */
    public function show(CarPlateWord $carPlateWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarPlateWord  $carPlateWord
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPlateWord $carPlateWord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarPlateWord  $carPlateWord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarPlateWord $carPlateWord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarPlateWord  $carPlateWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarPlateWord $carPlateWord)
    {
        //
    }
}
