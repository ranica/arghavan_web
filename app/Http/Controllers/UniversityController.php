<?php

namespace App\Http\Controllers;

use App\University;
use App\Http\Requests\UniversityRequest;
use Illuminate\Http\Request;

class UniversityController extends Controller
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
            $universities = University::paginate(Controller::C_PAGINATE_SIZE);

            return $universities;
        }

        return view ('universities.index');
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
    public function store(UniversityRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newUniversity = University::createIfNotExists($request);

            return [
                'status'   => is_null($newUniversity) ? 1 : 0,
                'university' => $newUniversity
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(UniversityRequest $request, University $university)
    {
        if ($request->ajax())
        {
            $university->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'university' => $university
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university, Request $request)
    {
        if ($request->ajax())
        {
            $university->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Load all Data University
     */

    public function allUniversity(Request $request)
    {
        if ($request->ajax())
        {
            $university = \App\University::all();

            return $university;
        }
    }
}
