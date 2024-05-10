<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Admins list';
        $data['records'] = User::getAdmins()->paginate(3);
        return view('admin.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add New Admin';
        $data['roles'] = Role::get();
        return view('admin.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users'
        ]);
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->role_id = $request->role_id;
        $role = Role::find($request->role_id);
        if (isset($role)) {
            $user->assignRole($role);
        }
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(10);
            $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/profile/', $fileName);
            $user->profile_pic = $fileName;
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin created successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['record'] = User::getSingleUser($id)->first();
        if (isset($data['record'])) {
            $data['header_title'] = 'Edit Admin Details';
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $user = User::getSingleUser($id)->first();
        if (isset($user)) {
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->user_type = 1;
            $user->role_id = $request->role_id;
            $role = Role::find($request->role_id);
            if (isset($role)) {
                $user->assignRole($role);
            }
            if (!empty($request->file('profile_pic'))) {
                if (!empty($user->getProfilePic())) {
                    if (file_exists('public/images/profile/'.$user->profile_pic)) {
                        unlink('public/images/profile/'.$user->profile_pic);
                    }
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $randomStr = Str::random(10);
                $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/profile/', $fileName);
                $user->profile_pic = $fileName;
            }
            $user->save();
            return redirect('admin/admin/list')->with('success', 'Admin updated successfully');
        } else {
            return redirect()->back()->with('error', 'User data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::getSingleUser($id)->first();
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Admins list';
        $data['records'] = User::getTrashedAdmins()->paginate(10);
        return view('admin.admin.trashed', $data);
    }
}
