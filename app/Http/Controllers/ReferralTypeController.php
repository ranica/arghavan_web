<?php

namespace App\Http\Controllers;

use App\ReferralType;
use Illuminate\Http\Request;
use App\Http\Requests\ReferralTypeRequest;

class ReferralTypeController extends Controller
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
            $referralType = ReferralType::paginate(Controller::C_PAGINATE_SIZE);

            return $referralType;
        }

        return view('referralTypes.index');
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
    public function store(ReferralTypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newReferralType = ReferralType::createIfNotExists($request);


            return [
                'status' => is_null($newReferralType) ? 1 : 0,
                'referralType'  => $newReferralType
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReferralType  $referralType
     * @return \Illuminate\Http\Response
     */
    public function show(ReferralType $referralType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReferralType  $referralType
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferralType $referralType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReferralType  $referralType
     * @return \Illuminate\Http\Response
     */
    public function update(ReferralTypeRequest $request, ReferralType $referralType)
    {
        if ($request->ajax())
        {
            $referralType->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'referralType' => $referralType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReferralType  $referralType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ReferralType $referralType)
    {
        if ($request->ajax())
        {
            $referralType->delete();

            return [
                'status' => 0
            ];
        }
    }
}
