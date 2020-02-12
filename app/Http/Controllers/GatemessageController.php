<?php

namespace App\Http\Controllers;

use App\Gatemessage;
use Illuminate\Http\Request;

class GatemessageController extends Controller
{
    public function manualData(Request $request)
    {
        if ($request->ajax())
        {
            $items = Gatemessage::where('message', 'like', '%'. 'تردد انجام شد'.'%')
                        ->get();

            return $items;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $gatemessage = Gatemessage::paginate(Controller::C_PAGINATE_SIZE);

            return $gatemessage;
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
     * @param  \App\Gatemessage  $gatemessage
     * @return \Illuminate\Http\Response
     */
    public function show(Gatemessage $gatemessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gatemessage  $gatemessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Gatemessage $gatemessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gatemessage  $gatemessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gatemessage $gatemessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gatemessage  $gatemessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gatemessage $gatemessage)
    {
        //
    }
}
