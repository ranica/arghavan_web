<?php

namespace App\Http\Controllers;
use App\Http\Requests\MelliatRequest;
use Illuminate\Http\Request;
use PDF;
use App\Melliat;

class MelliatController extends Controller
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
            $melliats = \App\Melliat::paginate(Controller::C_PAGINATE_SIZE);
            return $melliats;
        }

        return view ('melliats.index');
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
    public function store(MelliatRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newMelliat = \App\Melliat::createIfNotExist($request);

            return [
                'status' => is_null($newMelliat) ? 1 : 0,
                'melliat' => $newMelliat
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Melliat  $melliat
     * @return \Illuminate\Http\Response
     */
    public function show(Melliat $melliat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Melliat  $melliat
     * @return \Illuminate\Http\Response
     */
    public function edit(Melliat $melliat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Melliat  $melliat
     * @return \Illuminate\Http\Response
     */
    public function update(MelliatRequest $request, Melliat $melliat)
    {
        if ($request->ajax())
        {
            $melliat->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'melliat' => $melliat
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Melliat  $melliat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Melliat $melliat)
    {
        if ($request->ajax())
        {
            $melliat->delete();

            return [
                'status' => 0
            ];
        }
    }
}
