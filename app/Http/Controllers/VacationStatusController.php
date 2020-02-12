<?php

namespace App\Http\Controllers;

use App\VacationStatus;
use Illuminate\Http\Request;

class VacationStatusController extends Controller
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
            $vacationStatus = VacationStatus::paginate(Controller::C_PAGINATE_SIZE);
            return $vacationStatus;
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
     * @param  \App\VacationStatus  $vacationStatus
     * @return \Illuminate\Http\Response
     */
    public function show(VacationStatus $vacationStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VacationStatus  $vacationStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(VacationStatus $vacationStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VacationStatus  $vacationStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacationStatus $vacationStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VacationStatus  $vacationStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacationStatus $vacationStatus)
    {
        //
    }
}
