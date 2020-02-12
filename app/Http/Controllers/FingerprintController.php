<?php

namespace App\Http\Controllers;

use App\Fingerprint;
use Illuminate\Http\Request;

class FingerprintController extends Controller
{

    public function listDataFingerprint()
    {
        $fun = [
            'people' => function($q) {
                $q->select([
                    'id',
                    'name',
                    'lastname',
                    'nationalId',
                ]);
            },

            'fingerprint' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'fingerprint_user_id',
                    'image_quality',
                    'type_fingerprint',
                ]);
            },
        ];
        $res = \App\User::with($fun)
                    ->select(['users.id', 'code', 'email', 'state', 'level_id', 'people_id', 'group_id'])
                    ->get();

        return $res;
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function show(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fingerprint $fingerprint)
    {
        //
    }
}
