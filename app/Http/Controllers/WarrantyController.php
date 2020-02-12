<?php

namespace App\Http\Controllers;

use App\Warranty;
use Illuminate\Http\Request;
use App\Http\Requests\WarrantyRequest;


class WarrantyController extends Controller
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
            $warranty = Warranty::paginate(Controller::C_PAGINATE_SIZE);

            return $warranty;
        }

        return view('warranties.index');
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
    public function store(WarrantyRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newWarranty = Warranty::createIfNotExists($request);


            return [
                'status' => is_null($newWarranty) ? 1 : 0,
                'warranty'  => $newWarranty
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function show(Warranty $warranty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function edit(Warranty $warranty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function update(WarrantyRequest $request, Warranty $warranty)
    {
        if ($request->ajax())
        {
            $warranty->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'warranty' => $warranty
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Warranty $warranty)
    {
        if ($request->ajax())
        {
            $warranty->delete();

            return [
                'status' => 0
            ];
        }
    }
}
