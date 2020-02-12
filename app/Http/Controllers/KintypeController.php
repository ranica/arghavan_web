<?php

namespace App\Http\Controllers;

use App\Kintype;
use Illuminate\Http\Request;
use App\Http\Requests\KintypeRequest;


class KintypeController extends Controller
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
            $kintypes = Kintype::paginate(Controller::C_PAGINATE_SIZE);

            return $kintypes;
        }

        return view ('kintypes.index');
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
    public function store(KintypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newKintype = Kintype::createIfNotExist($request);

            return [
                'status' => is_null($newKintype) ? 1 : 0,
                'kintype' => $newKintype
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kintype  $kintype
     * @return \Illuminate\Http\Response
     */
    public function show(Kintype $kintype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kintype  $kintype
     * @return \Illuminate\Http\Response
     */
    public function edit(Kintype $kintype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kintype  $kintype
     * @return \Illuminate\Http\Response
     */
    public function update(KintypeRequest $request, Kintype $kintype)
    {
        if ($request->ajax())
        {
            $kintype->update([ 'name' => $request->name ]);

            return [
                'status' => 0,
                'kintype' => $kintype
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kintype  $kintype
     * @return \Illuminate\Http\Response
     */
    public function destroy(KintypeRequest $request, Kintype $kintype)
    {
         if ($request->ajax())
        {
            $kintype->delete();

            return [
                'status' => 0
            ];
        }
    }
}
