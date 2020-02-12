<?php

namespace App\Http\Controllers;

use App\Gategroup;
use App\Gatedevice;
use App\User;
use App\Http\Requests\GategroupRequest;
use Illuminate\Http\Request;

class GategroupController extends Controller
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
                $gategroups = Gategroup::with('gatedevices')
                                        ->paginate(Controller::C_PAGINATE_SIZE);

                return $gategroups;
            }

            return view('gategroups.index');
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
    public function store(GategroupRequest $request)
    {
         if ($request->ajax())
        {
            // Check for duplicate
            $newGateGroup = Gategroup::createIfNotExists($request);

            return [
                'status'   => is_null($newGateGroup) ? 1 : 0,
                'gategroup'     => $newGateGroup
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gategroup  $gategroup
     * @return \Illuminate\Http\Response
     */
    public function show(Gategroup $gategroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gategroup  $gategroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Gategroup $gategroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gategroup  $gategroup
     * @return \Illuminate\Http\Response
     */
    public function update(GategroupRequest $request, Gategroup $gategroup)
    {
        if ($request->ajax())
        {
            $gategroup->update([
                'name'  => $request->name,
                'description'  => $request->description,
            ]);

            return [
                'status'    => 0,
                'gategroup' => $gategroup
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gategroup  $gategroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gategroup $gategroup)
    {
        if ($request->ajax())
        {
            $gategroup->delete();

            return [
                'status' => 0
            ];
        }
    }

     /**
     * Set Gatedevice to GateGroup
     */
    public function setGatedevice(Request $request, Gategroup $gategroup)
    {
        $gatedevices = $request->gatedevices;

        if ($request->ajax())
        {
            $gategroup->giveGatedeviceTo($gatedevices);
            $gategroup->load(['gatedevices']);

            return [
                'status'   => is_null($gategroup) ? 1 : 0,
                'gategroup'     => $gategroup
            ];
        }
    }

     /**
     * Get all Gate Group
     */
    public function allGateGroup()
    {
        $list  = Gategroup::select('id', 'name', 'description')
                                ->get();

        return $list;
    }

    /**
     * Load Gate Group for search user
     * @param  Request $request [description]
     * @param  User    $user    [description]
     * @return [type]           [description]
     */
    public function loadGateGroup(Request $request, User $user)
    {
        if ($request->ajax())
        {

            $gategroups = 'SELECT  DISTINCT
                                    gategroups.id,
                                    gategroups.name,
                                    IF((SELECT gategroup_user.gategroup_id  FROM gategroup_user
                                         WHERE
                                            (gategroup_user.user_id =:userId
                                                and
                                            gategroup_user.gategroup_id = gategroups.id)),true, false) as permit
                            FROM
                                gategroups
                            LEFT JOIN gategroup_user ON gategroups.id = gategroup_user.gategroup_id';
            $data = ['userId' => $user->id];
            $query = \DB::select($gategroups, $data);

            return $query;
        }
    }
}
