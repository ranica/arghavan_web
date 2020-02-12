<?php

namespace App\Http\Controllers;

use App\Sms;
use App\Http\Requests\SmsRequest;
use Illuminate\Http\Request;

class SmsController extends Controller
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
            $sms = Sms::paginate(Controller::C_PAGINATE_SIZE);
            return $sms;
        }

        return view('sms.index');
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
    public function store(SmsRequest $request)
    {
        if ($request->ajax())
        {
            $user_id = \Auth::user()->id;
            $to      = $request->to;
            $message = $request->message;

            \App\Jobs\ProcessSendSMS::dispatch($to, $message, $user_id);

            return [
                'status' => 0,
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function show(Sms $sms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(Sms $sms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sms $sms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sms $sms)
    {
        if ($request->ajax())
        {
            $sms->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Get count posted SMS
     */
    public function CountPostedSMS()
    {
        try 
        {
            $count = \App\Sms::status()
                            ->count();
        }
        catch (\Exception $e) {
            $count = 0;
        }

        return $count;
    }
}
