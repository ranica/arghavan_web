<?php

namespace App\Http\Controllers;

use App\Gatepass;
use Illuminate\Http\Request;
use App\Http\Requests\GatepassRequest;


class GatepassController extends Controller
{
     public function manualData(Request $request)
    {
        if ($request->ajax())
        {
            $items = Gatepass::where('name', 'like', '%'. 'دستی'. '%')
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
            $items = Gatepass::where('name', 'NOT LIKE', '%'. 'دستی'. '%')
                        ->paginate(Controller::C_PAGINATE_SIZE);

            return $items;
        }

        return view ('gatepasses.index');
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
    public function store(GatepassRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newGatePass = Gatepass::createIfNotExist($request);

            return [
                'status' => is_null($newGatePass) ? 1 : 0,
                'gatepass' => $newGatePass
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gatepass  $gatepass
     * @return \Illuminate\Http\Response
     */
    public function show(Gatepass $gatepass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gatepass  $gatepass
     * @return \Illuminate\Http\Response
     */
    public function edit(Gatepass $gatepass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gatepass  $gatepass
     * @return \Illuminate\Http\Response
     */
    public function update(GatepassRequest $request, Gatepass $gatepass)
    {
        if ($request->ajax())
        {
            $gatepass->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'gatepass' => $gatepass
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gatepass  $gatepass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gatepass $gatepass)
    {
        if ($request->ajax())
        {
            $gatepass->delete();

            return [
                'status' => 0
            ];
        }
    }
}
