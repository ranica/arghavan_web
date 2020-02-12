<?php

namespace App\Http\Controllers;

use App\Gategender;
use Illuminate\Http\Request;

class GategenderController extends Controller
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
            $gategender = Gategender::paginate(Controller::C_PAGINATE_SIZE);
            
            return $gategender;
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
     * @param  \App\Gategender  $gategender
     * @return \Illuminate\Http\Response
     */
    public function show(Gategender $gategender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gategender  $gategender
     * @return \Illuminate\Http\Response
     */
    public function edit(Gategender $gategender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gategender  $gategender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gategender $gategender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gategender  $gategender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gategender $gategender)
    {
        //
    }
}
