<?php

namespace App\Http\Controllers;

use App\VacationRequest;
use App\VacationStatus;
use App\VacationType;
use Illuminate\Http\Request;
use App\Http\Requests\CheckVacationRequest;


class VacationRequestController extends Controller
{
    public static $relation = ['vacationType',
                                'vacationStatus',
                                'user',
                                'user.people'
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
            $vacationRequest = VacationRequest::with(self::$relation)
                                    ->orderBy('created_at','DESC')
                                    ->paginate(Controller::C_PAGINATE_SIZE);

            return $vacationRequest;
        }
        return view('vacationRequests.index');
    }
    /**
     * Managment Vacation
     */
    public function managment(Request $request)
    {
        return view('vacationManagment.index');
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
    public function store(CheckVacationRequest $request)
    {
        if ($request->ajax())
        {
            if($request->vacationType_id == \App\VacationRequest::$VACATION_CLOCK)
            {
                $request->finish_date = $request->begin_date;
            }
            // Check for duplicate
            $newRequest = \App\VacationRequest::createIfNotExists($request);

            $newRequest->load(self::$relation)->get();
            return [
                'status' => is_null($newRequest) ? 1 : 0,
                'vacationRequest'  => $newRequest
            ];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\VacationRequest  $vacationRequest
     * @return \Illuminate\Http\Response
     */
    public function show(VacationRequest $vacationRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VacationRequest  $vacationRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(VacationRequest $vacationRequest)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VacationRequest  $vacationRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacationRequest $vacationRequest)
    {
        if ($request->ajax())
        {
            $vacationRequest->update([
                        'subject' => $request->subject,
                        'vacation_status_id' => $request->vacationStatus_id,
                        'vacation_type_id' => $request->vacationType_id,
                        'begin_hour' => $request->begin_hour,
                        'finish_hour' => $request->finish_hour,
                        'begin_date' => $request->begin_date,
                        'finish_date'=> $request->finish_date,
            ]);
            $vacationRequest->load(self::$relation)->get();
            return [
                'status' => 0,
                'vacationRequest'  => $vacationRequest
            ];
        }
    }
    /**
     * Update Only read_at
     */
    public function updateField(Request $request, VacationRequest $vacationRequest)
    {
        if ($request->ajax())
        {
            $vacationRequest->update([
                        'seen_at' => \Carbon\Carbon::today(),
            ]);

            $vacationRequest->load(self::$relation)->get();

            return [
                'status' => 0,
                'vacationRequest'  => $vacationRequest
            ];
        }
    }

    /**
     * Update Only read_at
     */
    public function updateRequest(Request $request, VacationRequest $vacationRequest)
    {
        if ($request->ajax())
        {
            $vacationRequest->update([
                        'responsed_at' => \Carbon\Carbon::today(),
                        'vacation_status_id' => $request->vacationStatus_id,
                        'extra' => [
                                'subject' => $request->subject,
                                'user_id' => $request->user_id,
                                'responsed_user_id' => \Auth::user()->id,
                                'vacation_status_id' => $request->status_id,
                                'vacation_type_id' => $request->vacationType_id,
                                'user_id' => $request->user_id,
                                'begin_hour_request' => $request->begin_hour,
                                'finish_hour_request' => $request->finish_hour,
                                'begin_date_request' => $request->begin_date,
                                'finish_date_request' => $request->finish_date,
                                'responsed_at' => \Carbon\Carbon::today(),
                                'seen_at' => $request->seen_at,
                            ],
                ]);
            $vacationRequest->load(self::$relation)->get();

            return [
                'status' => 0,
                'vacationRequest'  => $vacationRequest
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VacationRequest  $vacationRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VacationRequest $vacationRequest)
    {
        if ($request->ajax())
        {
            $vacationRequest->delete();

            return [
                'status' => 0
            ];
        }
    }
    /**
     * Get Unread Vaction request
     */
    public function unreadVacationRequest()
    {
        return \App\VacationRequest::getVacationUnReaded();
    }
}
