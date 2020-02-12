<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
            $permissions = Permission::paginate(Controller::C_PAGINATE_SIZE);

            return $permissions;
        }

        return view ('permissions.index');
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
   public function store(PermissionRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newPermission = Permission::createIfNotExist($request);

            return [
                'status' => is_null($newPermission) ? 1 : 0,
                'permission' => $newPermission
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        if ($request->ajax())
        {
            $permission->update([
                                'key'  => $request->key,
                                'name'  => $request->name,
                                'description'  => $request->description,
                                ]);

            return [
                'status' => 0,
                'permission' => $permission
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        if ($request->ajax())
        {
            $permission->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Return permissions list
     */
    public function allPermissions ()
    {
        $list_all  = Permission::select('id', 'key', 'subkey' ,'name', 'description')
                                ->get();

        $list_dashboard  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'dashboard')
                                        ->get();

        $list_menuStructure  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                            ->where('key', 'menu_structure')
                                            ->get();

        $list_menuUser  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_user')
                                        ->get();

        $list_menuGate  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_gate')
                                        ->get();
        $list_menuSettingGate  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                                ->where('key', 'menu_setting')
                                                ->get();

        $list_menuSettingSystem  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                                ->where('key', 'menu_auth')
                                                ->get();

        $list_menuReport  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_report')
                                        ->get();

        $list_menuReferral  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_referral')
                                        ->get();

        $list_menuDormitory  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_management_dormitory')
                                        ->get();

        $list_menuRequest  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_request')
                                        ->get();

        $list_menuSMS  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_sms')
                                        ->get();

        $list_menuParking  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'menu_parking')
                                        ->get();


        $list_button  = Permission::select('id', 'key', 'subkey', 'name', 'description')
                                        ->where('key', 'command')
                                        ->get();

        return [
            'all' => $list_all,
            'dashboard' => $list_dashboard,
            'menuStructure' => $list_menuStructure,
            'menuUser' => $list_menuUser,
            'menuGate' => $list_menuGate,
            'menuSettingGate' => $list_menuSettingGate,
            'menuSettingSystem' => $list_menuSettingSystem,
            'menuReport' => $list_menuReport,
            'menuReferral' => $list_menuReferral,
            'menuDormitory' => $list_menuDormitory,
            'menuRequest' => $list_menuRequest,
            'menuSMS' => $list_menuSMS,
            'menuParking' => $list_menuParking,
            'listButton' => $list_button,
        ];
    }

}
