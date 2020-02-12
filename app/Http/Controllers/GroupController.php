<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
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
            $group = Group::paginate(Controller::C_PAGINATE_SIZE);

            return $group;
        }

        return view('groups.index');
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
    public function store(GroupRequest $request)
    {
         if ($request->ajax())
        {
            // Check for duplicate
            $newGroup = Group::createIfNotExists($request);


            return [
                'status' => is_null($newGroup) ? 1 : 0,
                'group'  => $newGroup
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
     public function update(GroupRequest $request, Group $group)
    {
        if ($request->ajax())
        {
            $group->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'group' => $group
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        if ($request->ajax())
        {
            $group->delete();

            return [
                'status' => 0
            ];
        }
    }
}
