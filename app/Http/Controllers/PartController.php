<?php

namespace App\Http\Controllers;

use App\Part;
use App\Http\Requests\PartRequest;
use Illuminate\Http\Request;

class PartController extends Controller
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
            $parts = Part::paginate(Controller::C_PAGINATE_SIZE);

            return $parts;
        }

        return view('parts.index');
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
    public function store(PartRequest $request)
    {
        if ($request->ajax())
        {
            $newPart = Part::createIfNotExists($request);

            return [
                'status' => is_null($newPart) ? 1 : 0,
                'part' => $newPart
            ];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, Part $part)
    {
        if ($request->ajax())
        {            
            $part->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'part'     => $part
            ];
        }      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part,Request $request)
    {
        if ($request->ajax())
        {
            $part->delete();
            
            return [
                'status' => 0
            ];
        }  
    }
}
