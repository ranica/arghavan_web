<?php

namespace App\Http\Controllers;

use App\Gateoption;
use Illuminate\Http\Request;
use App\Http\Requests\GateoptionRequest;

class GateoptionController extends Controller
{
    public static $relation =[
        'gatezoneW',
        'gatezoneM',
        'gatedevices'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $gateoptions = Gateoption::with(self::$relation)
                        ->paginate(Controller::C_PAGINATE_SIZE);
            return $gateoptions;
        }
        return view('gateoptions.index');
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
    public function store(GateoptionRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newGateoption = Gateoption::createIfNotExists($request);

            $newGateoption->load(self::$relation)->get();

            return [
                'status'     => is_null($newGateoption) ? 1 : 0,
                'gateoption' => $newGateoption
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gateoption  $gateoption
     * @return \Illuminate\Http\Response
     */
    public function show(Gateoption $gateoption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gateoption  $gateoption
     * @return \Illuminate\Http\Response
     */
    public function edit(Gateoption $gateoption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gateoption  $gateoption
     * @return \Illuminate\Http\Response
     */
    public function update(GateoptionRequest $request, Gateoption $gateoption)
    {
        if ($request->ajax())
        {
            $gateoption->update([
                'startDate'   => $request->startDate,
                'endDate'     => $request->endDate,
                'port'        => $request->port,
                'emergency'   => $request->emergency,
                'genzonew_id' => $request->genzonew_id,
                'genzonem_id' => $request->genzonem_id
            ]);

            $gateoption->load(self::$relation)->get();
            return [
                'status' => 0,
                'gateoption'   => $gateoption
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gateoption  $gateoption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gateoption $gateoption)
    {
        if ($request->ajax())
        {
            $gateoption->delete();

            return [
                'status' => 0
            ];
        }
    }

     /**
     * Set Gatedevice to role
     */
    public function setGatedevice(Request $request, Gateoption $gateoption)
    {
        $gatedevices = $request->gatedevices;

        if ($request->ajax())
        {
            $gateoption->giveGatedeviceTo($gatedevices);
            $gateoption->load(self::$relation);

            return [
                'status'   => is_null($gateoption) ? 1 : 0,
                'gateoption'     => $gateoption
            ];
        }
    }
}
