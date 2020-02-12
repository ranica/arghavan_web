<?php

namespace App\Http\Controllers;

use App\Gatedirect;
use Illuminate\Http\Request;

class GatedirectController extends Controller
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
            $gatedirect = Gatedirect::paginate(Controller::C_PAGINATE_SIZE);

            return $gatedirect;
        }
    }

    /**
     * Load Data manual Traffic
     * @return [type] [description]
     */
    public function manualData(Request $request)
    {
        if ($request->ajax())
        {
            $items = Gatedirect::where('type', '=', '0')
                            ->get();
            return $items;
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
     * @param  \App\Gatedirect  $gatedirect
     * @return \Illuminate\Http\Response
     */
    public function show(Gatedirect $gatedirect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gatedirect  $gatedirect
     * @return \Illuminate\Http\Response
     */
    public function edit(Gatedirect $gatedirect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gatedirect  $gatedirect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gatedirect $gatedirect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gatedirect  $gatedirect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gatedirect $gatedirect)
    {
        //
    }
}
