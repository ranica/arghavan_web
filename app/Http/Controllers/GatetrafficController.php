<?php

namespace App\Http\Controllers;

use App\Gatetraffic;
use Illuminate\Http\Request;
use Illuminate\Http\Request\GatetrafficRequest;
use App\Exports\ReportTrafficExport;
use App\Exports\ReportTrafficPDFExport;
use Maatwebsite\Excel\Facades\Excel;

class GatetrafficController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->ajax()){
            // Check for duplicate
            $newGateTraffic = Gatetraffic::createIfNotExist($request);
            $newGateTraffic = ReportController::getTraffics($request, $newGateTraffic->id)[0];
            return [
                'status' => is_null($newGateTraffic) ? 1 : 0,
                'gatetraffic' => $newGateTraffic
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gatetraffic  $gatetraffic
     * @return \Illuminate\Http\Response
     */
    public function show(Gatetraffic $gatetraffic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gatetraffic  $gatetraffic
     * @return \Illuminate\Http\Response
     */
    public function edit(Gatetraffic $gatetraffic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gatetraffic  $gatetraffic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gatetraffic $gatetraffic)
    {
        if ($request->ajax())
        {
            $gatetraffic->update(['user_id' => $request->user_id,
                                  'gatedirect_id' => $request->gatedirect_id,
                                  'gatemessage_id' => $request->gatemessage_id,
                                  'gatedevice_idf' => $request->gatedevice_id,
                                  'gatepass_id' => $request->gatepass_id,
                                  'gatedate' => $request->gatedate,
                    ]);

            $gatetraffic = ReportController::getTraffics($request, $gatetraffic->id)[0];
            return [
                'status' => 0,
                'gatetraffic' => $gatetraffic
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gatetraffic  $gatetraffic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gatetraffic $gatetraffic)
    {
        if ($request->ajax())
         {
            $gatetraffic->delete();

            return [
                'status' => 0
            ];
        }
    }

     /**
     * Export traffic to Excel
     */
    public function trafficExportToExcel(Request $request)
    {
        $exportGateTraffic = new ReportTrafficExport ($request);
        return $exportGateTraffic->download('report.xlsx');
    }
      /**
     * Export traffic to PDF
     */
    public function trafficExportToPDF(Request $request)
    {
        $exportGateTraffic = new ReportTrafficPDFExport ($request);
        return $exportGateTraffic->download('invoices.pdf');
    }
}
