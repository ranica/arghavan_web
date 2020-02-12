<?php

namespace App\Http\Controllers;

use App\VacationType;
use Illuminate\Http\Request;

class VacationTypeController extends Controller
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
            $vacationType = VacationType::paginate(Controller::C_PAGINATE_SIZE);
            return $vacationType;
        }
        return view ('vacationTypes.index');

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
     * @param  \App\VacationType  $vacationType
     * @return \Illuminate\Http\Response
     */
    public function show(VacationType $vacationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VacationType  $vacationType
     * @return \Illuminate\Http\Response
     */
    public function edit(VacationType $vacationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VacationType  $vacationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacationType $vacationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VacationType  $vacationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacationType $vacationType)
    {
        //
    }
}
