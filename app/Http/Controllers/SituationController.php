<?php

namespace App\Http\Controllers;

use App\Situation;
use Illuminate\Http\Request;
use App\Http\Requests\SituationRequest;
// use Illuminate\Foundation\Http\FormRequest;

class SituationController extends Controller
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
            $situations = Situation::paginate(Controller::C_PAGINATE_SIZE);  

            return $situations;
        }

        return view('situations.index');
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
    public function store(SituationRequest $request)
    {
        if ($request->ajax())
        { 
            // Check for duplicate
            $newSituation = Situation::createIfNotExists($request);          
            
            return [
                'status'        => is_null($newSituation) ? 1 : 0,
                'situation'     => $newSituation
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function show(Situation $situation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function edit(Situation $situation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function update(SituationRequest $request, Situation $situation)
    {
        if ($request->ajax())
        {
            $situation->update([
                'name'  => $request->name,
                'state' => $request->state
            ]);           

            return [
                'status'    => 0,
                'situation' => $situation
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Situation $situation)
    {
        if ($request->ajax())
        {
            $situation->delete();

            return [
                'status' => 0
            ];
        }
    }
}
