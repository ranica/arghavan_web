<?php

namespace App\Http\Controllers;

use App\Gatezone;
use Illuminate\Http\Request;

class GatezoneController extends Controller
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
            $gatezone = Gatezone::paginate(Controller::C_PAGINATE_SIZE);

            return $gatezone;
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
     * @param  \App\Gatezone  $gatezone
     * @return \Illuminate\Http\Response
     */
    public function show(Gatezone $gatezone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gatezone  $gatezone
     * @return \Illuminate\Http\Response
     */
    public function edit(Gatezone $gatezone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gatezone  $gatezone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gatezone $gatezone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gatezone  $gatezone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gatezone $gatezone)
    {
        //
    }
}
