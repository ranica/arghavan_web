<?php

namespace App\Http\Controllers;

use App\GatePlan;
use Illuminate\Http\Request;
use App\Http\Requests\GatePlanRequest;


class GatePlanController extends Controller
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
            $gate_plans = GatePlan::with('schedules')
                                    ->paginate(Controller::C_PAGINATE_SIZE);
            return $gate_plans;
        }

        return view('gate_plans.index');
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
    public function store(GatePlanRequest $request)
    {
        if ($request->ajax())
        {
            $collection = collect([]);
            foreach ($request->weekdays as $variable) {
                $newSchedule = \App\Schedule::createIfNotExist((object)$variable);
                $collection->push($newSchedule->id);
            }
            $newGatePlan = \App\GatePlan::createIfNotExist($request);

            $newGatePlan->giveScheduleTo($collection);
            $newGatePlan->load(['schedules']);

            return [
                'status' => is_null($newGatePlan) ? 1 : 0,
                'gatePlan' => $newGatePlan
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GatePlan  $gatePlan
     * @return \Illuminate\Http\Response
     */
    public function show(GatePlan $gatePlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GatePlan  $gatePlan
     * @return \Illuminate\Http\Response
     */
    public function edit(GatePlan $gatePlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GatePlan  $gatePlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GatePlan $gatePlan)
    {
        $found = null;
        $collection = collect([]);
        $collectionOld = collect([]);
        $arrSchedule = collect([]);

        if ($request->ajax())
        {
            foreach ($request->oldWeekdays as $variable) {
                $collectionOld->push($variable['id']);
            }

            foreach ($request->weekdays as $variable) {
                $collection->push($variable['id']);
            }

            foreach ($request->weekdays as $variable) {
                if ( 0 == $variable['id'])
                {
                    // Insert new schedule
                    $x = $variable['id'];
                    // echo " insert $x";
                    $newSchedule = \App\Schedule::createIfNotExist((object)$variable);
                    $arrSchedule->push($newSchedule->id);
                }
            }

            $arr = array_diff($collection->toArray(), array("0"));
            $gatePlan->giveScheduleTo(array_merge($arr,$arrSchedule->toArray()));

            foreach($collectionOld->toArray() as $num) {
                if (in_array($num,$collection->toArray())) {
                    // update schedule
                    $found[$num] = true;
                    $schedule = \App\Schedule::where('id', $num)
                                             ->first();
                    foreach ($request->weekdays as $key) {
                        $item = (object)$key;
                        if ($item->id == $num)
                        {

                            $schedule->update([
                                                'index'         => $item->index,
                                                'name'          => $item->name,
                                                'begin_time'    => $item->begin,
                                                'end_time'      => $item->end,
                                                'begin_number'  => $item->start_value,
                                                'end_number'    => $item->end_value,
                                            ]);
                            // echo " update  $num ";
                        }
                    }
                }
                else {

                    $found[$num] = false;
                    // echo " delete  $num ";

                    if (($num != 0 )|| (!is_empty($num)))
                    {
                        $schedule = \App\Schedule::where('id', $num)
                                             ->first();

                        $schedule->delete();
                        $gatePlan->takeScheduleFrom($schedule);
                    }
                }
            }

            $gatePlan->update([ 'name' => $request->name ]);
            $gatePlan->load(['schedules']);


            return [
                'status' => 0,
                'gatePlan' => $gatePlan
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GatePlan  $gatePlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GatePlan $gatePlan)
    {
        if ($request->ajax())
        {
            $gatePlan->delete();

            return [
                'status' => 0
            ];
        }
    }

     /**
     * Set Schedule to GatePlan
     */
    public function setSchedule(Request $request, GatePlan $gatePlan)
    {
        $schedules = $request->$schedules;

        if ($request->ajax())
        {
            $gatePlan->giveScheduleTo($schedules);
            $gatePlan->load(['schedules']);

            return [
                'status'   => is_null($gatePlan) ? 1 : 0,
                'gatePlan'     => $gatePlan
            ];
        }
    }
}
