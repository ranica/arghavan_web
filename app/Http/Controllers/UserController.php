<?php

namespace App\Http\Controllers;

use App\User;
use App\Gategroup;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\ReportTrafficExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $data = User::where('code', $user->code)
                        ->get();

        return [
            'status'   => is_null($data) ? 1 : 0,
            'data'     => $data
        ];
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
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function export()
    {
        return (new UsersExport(1000))->download('invoices.xlsx');
    }

    public function checkExsit(Request $request)
    {
        if ($request->ajax())
        {
            $exsitUser = \App\User::where('code' , $request->code)
                            ->first();

            if (! is_null($exsitUser))
            {
                return [
                    'exists' => true,
                    'data'  => [
                        'code'=> $exsitUser->code
                    ],
                ];
            }

            return [
                'exists' => false,
                'data' => []
            ];
        }
    }

    /**
     * Upload Image from  Folder: D:\Data\WebSites\iauahvazSoft\A_University\public\upload_images
     * create upload_images folder in public folder
     */


}
