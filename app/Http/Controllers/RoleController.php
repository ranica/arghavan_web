<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;


class RoleController extends Controller
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
                $roles = Role::with('permissions')
                             ->paginate(Controller::C_PAGINATE_SIZE);

                return $roles;
            }

            return view('roles.index');
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
    public function store(RoleRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newRole = Role::createIfNotExists($request);

            return [
                'status'   => is_null($newRole) ? 1 : 0,
                'role'     => $newRole
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        if ($request->ajax())
        {
            $role->update([
                'name'  => $request->name,
                'description'  => $request->description,
                'state' => $request->state
            ]);

            return [
                'status'    => 0,
                'role' => $role
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        if ($request->ajax())
        {
            $role->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Set permission to role
     */
    public function setPermission(Request $request, Role $role)
    {
        $permissions = $request->permissions;

        if ($request->ajax())
        {
            $role->givePermissionTo($permissions);
            $role->load(['permissions']);

            return [
                'status'   => is_null($role) ? 1 : 0,
                'role'     => $role
            ];
        }
    }

    /**
     * Return roles list
     */
    public function allRoles ()
    {
        $list  = Role::activeRoles()
                    ->select('id', 'name', 'description')
                    ->get();

        return $list;
    }
}
