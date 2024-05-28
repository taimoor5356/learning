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
        $data['records'] = Role::paginate(25);
        return view('admin.acl.roles', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRole()
    {
        //
        $data['header_title'] = 'Create Role';
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
        try {
            $permissionIds = $request->permission_id;
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role = Role::create([
                'name' => strtolower($request->role_name),
                'guard_name' => 'web'
            ]);
            $role->syncPermissions($permissions);
            return response()->json([
                'status' => true,
                'message' => 'Successfull'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
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
    public function editRole($id)
    {
        //
        $data['header_title'] = 'Edit Role';
        $data['role'] = Role::find($id);
        $data['permissionModule'] = Role::get();
        $data['permissions'] = Permission::get();
        return view('admin.acl.edit_role', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRole(Request $request, $id)
    {
        //
        try {
            $permissionIds = $request->permission_id;
            $permissions = Permission::whereIn('id', $permissionIds)->get();
            $role = Role::find($id);
            $role->name = strtolower($request->role_name);
            $role->save(); //remove all save
            $role->syncPermissions([]);
            $role->syncPermissions($permissions);
            return response()->json([
                'status' => true,
                'message' => 'Successfull'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolePermission)
    {
        //
    }
}
