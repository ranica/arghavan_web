<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;
use App\Http\Requests\ContractorRequest;


class ContractorController extends Controller
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
            $contractor = Contractor::paginate($this->C_PAGE_SIZE);

            return $contractor;
        }

        return view('contractors.index');
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
    public function store(ContractorRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newContractor = Contractor::createIfNotExists($request);


            return [
                'status' => is_null($newContractor) ? 1 : 0,
                'contractor'  => $newContractor
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(Contractor $contractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(ContractorRequest $request, Contractor $contractor)
    {
        if ($request->ajax())
        {
            $contractor->update([
                    'name' => $request->name,
                    'beginDate' => $request->beginDate,
                    'endDate' => $request->endDate,
                    'state' => $request->state,
                ]);

            return [
                'status'   => 0,
                'contractor' => $contractor
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contractor $contractor)
    {
        if ($request->ajax())
        {
            $contractor->delete();

            return [
                'status' => 0
            ];
        }
    }
}
