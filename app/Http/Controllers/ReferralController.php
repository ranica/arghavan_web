<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use App\Http\Requests\ReferralRequest;

class ReferralController extends Controller
{
     public static $relation = [
            'user',
            'gender',
            'department',
            'warranty',
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
            $referral = Referral::with(self::$relation)
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $referral;
        }

        return view('referrals.index');
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
    public function store(ReferralRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newReferral = Referral::createIfNotExists($request);

            $newReferral->load(self::$relation)->get();

            return [
                'status' => is_null($newReferral) ? 1 : 0,
                'referral'  => $newReferral
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(ReferralRequest $request, Referral $referral)
    {
        if ($request->ajax())
        {
            $referral->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'nationalId' => $request->nationalId,
                'mobile' => $request->mobile,
                'organization' => $request->organization,
                'referral_type_id' => $request->referral_type_id,
                'gender_id' => $request->gender_id,
                'user_id' => $request->user_id,
                'department_id' => $request->department_id,
                'warranty_id' => $request->warranty_id,
            ]);

            $referral->load(self::$relation)->get();

            return [
                'status' => 0,
                'referral'  => $referral
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Referral $referral)
    {
        if ($request->ajax())
        {
            $referral->delete();

            return [
                'status' => 0
            ];
        }
    }
    /**
     * Count Referral
     */
    public function countReferral()
    {
        try {
            $count = 0;
           // $count = \App\Referral::count();
        }
        catch (\Exception $e) {
            $count = 0;
        }

        return $count;
    }
}
