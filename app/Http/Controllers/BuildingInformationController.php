<?php

namespace App\Http\Controllers;

use App\BuildingInformation;
use Illuminate\Http\Request;
use App\Http\Requests\BuildingInformationRequest;


class BuildingInformationController extends Controller
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
            $building_informations = BuildingInformation::with('degree','term.semester', 'gatePlan','building')
                          ->paginate(Controller::C_PAGINATE_SIZE);

            return $building_informations;
        }

        return view('dormitories.index');
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

    public function store(BuildingInformationRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newDormitory = BuildingInformation::createIfNotExists($request);

            $newDormitory->load('degree')->get();
            $newDormitory->load('building')->get();
            $newDormitory->load('gatePlan')->get();
            $newDormitory->load('term.semester')->get();

            return [
                'status' => is_null($newDormitory) ? 1 : 0,
                'buildingInformation'   => $newDormitory
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuildingInformation  $buildingInformation
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingInformation $buildingInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuildingInformation  $buildingInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingInformation $buildingInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuildingInformation  $buildingInformation
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingInformationRequest $request, BuildingInformation $buildingInformation)
    {
        if ($request->ajax())
        {
            $buildingInformation->update([
                'degree_id'     => $request->degree_id,
                'term_id'       => $request->term_id,
                'building_id'   => $request->building_id,
                'gate_plan_id'   => $request->gatePlan_id,
            ]);

            $buildingInformation->load('degree')->get();
            $buildingInformation->load('building')->get();
            $buildingInformation->load('gatePlan')->get();
            $buildingInformation->load('term.semester')->get();

            return [
                'status' => 0,
                'buildingInformation'   => $buildingInformation
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuildingInformation  $buildingInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BuildingInformation $buildingInformation)
    {
        if ($request->ajax())
        {
            $buildingInformation->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Load Dormitory Information when load program
     */
    public function dormitoryInformation(Request $request)
    {
        $C_DORMITORY_INFORMATION = 'dormitory_information';

        $result = \Cache::get ($C_DORMITORY_INFORMATION, NULL);

        if (! is_null ($result))
        {
            return $result;
        }

        $result = \Cache::rememberForever ($C_DORMITORY_INFORMATION, function () {
            $system_info = \App\SystemInfo::select('value')
                                            ->get();
            $groups = null;
            if($system_info[0]->value){
                $groups = \App\Group::select (['id',
                                               'name'])
                                    ->get ();
            }
            else{
                $groups = \App\Group::where('name', 'کارمند')
                                    ->select (['id',
                                               'name'])
                                    ->get ();
            }

            $buildings = \App\Building::select (['id',
                                                'name'])
                                ->get ();

            $terms = \App\Term::with('semester')
                                ->select (['id',
                                            'semester_id',
                                            'year',
                                            'startDate',
                                            'endDate'])
                                  ->get ();
            $degrees = \App\Degree::select (['id',
                                            'name'])
                                     ->get ();
            $gatePlans = \App\GatePlan::select (['id',
                                                'name'])
                                     ->get ();


            $result = [
                        'groups'       => $groups,
                        'degrees'        => $degrees,
                        'buildings'      => $buildings,
                        'gatePlans'      => $gatePlans,
                        'terms'           => $terms,
                   ];

            return $result;
        });
        return $result;
    }
}
