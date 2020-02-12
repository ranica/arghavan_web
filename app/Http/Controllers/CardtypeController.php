<?php

namespace App\Http\Controllers;

use App\Cardtype;
use Illuminate\Http\Request;
use App\Http\Requests\CardTypeRequest;

class CardtypeController extends Controller
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
            $cardtype = Cardtype::paginate(Controller::C_PAGINATE_SIZE);

            return $cardtype;
        }

        return view('cardtypes.index');
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
    public function store(CardTypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newCardtype = Cardtype::createIfNotExists($request);          

            return [
                'status' => is_null($newCardtype) ? 1 : 0,
                'cardtype'  => $newCardtype
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardtype  $cardtype
     * @return \Illuminate\Http\Response
     */
    public function show(Cardtype $cardtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cardtype  $cardtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Cardtype $cardtype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardtype  $cardtype
     * @return \Illuminate\Http\Response
     */
    public function update(CardTypeRequest $request, Cardtype $cardtype)
    {
        if ($request->ajax())
        {            
            $cardtype->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'cardtype' => $cardtype
            ];
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardtype  $cardtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cardtype $cardtype)
    {
        if ($request->ajax())
        {
            $cardtype->delete();
            
            return [
                'status' => 0
            ];
        }  
    }
}
