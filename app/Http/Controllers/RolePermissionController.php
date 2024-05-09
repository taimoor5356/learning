<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function roles()
    {
        //
        $data['header_title'] = 'Roles';
        $data['records'] = Role::paginate(10);
        return view('admin.acl.roles', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRole()
    {
        //
        $data['permissionModule'] = Role::get();
        $data['permissions'] = Permission::get();
        return view('admin.acl.create_role', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeRole(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editRole(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRole(Request $request, RolePermission $rolePermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolePermission)
    {
        //
    }
}
