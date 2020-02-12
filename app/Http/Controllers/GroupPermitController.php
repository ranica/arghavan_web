<?php

namespace App\Http\Controllers;

use App\GroupPermit;
use App\Role;
use App\User;
use App\Http\Requests\GroupPermitRequest;
use Illuminate\Http\Request;

class GroupPermitController extends Controller
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
            $grouppermits = GroupPermit::with('roles')
                                        ->paginate(Controller::C_PAGINATE_SIZE);

            return $grouppermits;
        }

        return view('grouppermits.index');
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
    public function store(GroupPermitRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newGroupPermit = GroupPermit::createIfNotExist($request);

            return [
                'status' => is_null($newGroupPermit) ? 1 : 0,
                'grouppermit' => $newGroupPermit
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupPermit  $groupPermit
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPermit $groupPermit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupPermit  $groupPermit
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPermit $groupPermit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupPermit  $groupPermit
     * @return \Illuminate\Http\Response
     */
    public function update(GroupPermitRequest $request, GroupPermit $grouppermit)
    {
        if ($request->ajax())
        {
            $grouppermit->update([ 
                                'name'  => $request->name,
                                'description'  => $request->description,
                                ]);

            return [
                'status' => 0,
                'grouppermit' => $grouppermit
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupPermit  $groupPermit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GroupPermit $grouppermit)
    {
        if ($request->ajax())
        {
            $grouppermit->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Set Role To Group_Permit
     */
    public function setRole(Request $request, GroupPermit $grouppermit)
    {
        $roles = $request->roles;

        if ($request->ajax())
        { 
            $grouppermit->giveRoleTo($roles);
            $grouppermit->load(['roles']);
            
            return [
                'status'   => is_null($grouppermit) ? 1 : 0,
                'grouppermit'     => $grouppermit
            ];
        }
    }

    /**
     * Get all Group_permit
     */
    public function allGroupPermit()
    {
        $list  = GroupPermit::select('id', 'name', 'description')
                                ->get();

        return $list;
    }


    /**
     * Load Group Permit in use search data report
     */
    public function loadGroupPermit(Request $request, User $user)
    {
        if ($request->ajax())
        {
            $grouppermits = 'SELECT  DISTINCT   group_permits.id, 
                                                group_permits.name as name , 
                                                IF((SELECT group_permit_user.group_permit_id 
                                                    FROM group_permit_user
                                                    WHERE (group_permit_user.user_id = :userId 
                                                        and 
                                                        group_permit_user.group_permit_id = group_permits.id)),true,false) as permit
                            FROM group_permits

                            LEFT JOIN group_permit_user ON group_permits.id = group_permit_user.group_permit_id';
            $data = ['userId' => $user->id];
            $query = \DB::select($grouppermits, $data);
            return $query;
        }
    }
   
}
