<?php

namespace App\Http\Controllers;

use App\Degree;
use Illuminate\Http\Request;
use App\Http\Requests\DegreeRequest;

class DegreeController extends Controller
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
            $degree = Degree::paginate($this->C_PAGE_SIZE);

            return $degree;
        }

        return view('degrees.index');
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
    public function store(DegreeRequest $request)
    {
         if ($request->ajax())
        {
            // Check for duplicate
            $newDegree = Degree::createIfNotExists($request);
          

            return [
                'status' => is_null($newDegree) ? 1 : 0,
                'degree'  => $newDegree
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(DegreeRequest $request, Degree $degree)
    {
        if ($request->ajax())
        {            
            $degree->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'degree' => $degree
            ];
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Degree $degree)
    {
        if ($request->ajax())
        {
            $degree->delete();
            
            return [
                'status' => 0
            ];
        }  
    }
}
