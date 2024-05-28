<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentFormRequest;
use App\Models\Examination;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function editPassword()
    {
        $data['header_title'] = 'Edit Account Password';
        return view('profile.edit_password', $data);
    }
    public function updatePassword(Request $request)
    {
        request()->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user = User::getSingleUser(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                $user->save(); //remove all save
                return redirect()->back()->with('success', 'Password updated successfully');
            } else {
                return redirect()->back()->with('error', 'New password and confirm password does not match');
            }
        } else {
            return redirect()->back()->with('error', 'Old password does not match');
        }
    }
    public function myAccount()
    {
        $data['header_title'] = 'My Account';
        $data['record'] = User::getSingleUser(Auth::user()->id)->first();
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['exams'] = Examination::getExams()->get();
        if (Auth::user()->user_type == 1) {
            return view('admin.my_account', $data);
        } else if (Auth::user()->user_type == 2) {
            return view('teacher.my_account', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('student.my_account', $data);
        } else if (Auth::user()->user_type == 4) {
            return view('parent.my_account', $data);
        }
    }
    public function updateMyAdminAccount(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id
        ]);
        $user = User::getSingleUser($id)->first();
        if (isset($user)) {
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->role_id = $request->role_id;
            $role = Role::find($request->role_id);
            if (isset($role)) {
                $user->assignRole($role);
            }
            if (!empty($request->file('profile_pic'))) {
                if (!empty($user->profile_pic) && file_exists('public/images/profile/' . $user->profile_pic)) {
                    unlink('public/images/profile/' . $user->profile_pic);
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $randomStr = Str::random(10);
                $fileName = 'adm' . strtolower($randomStr) . '.' . $ext;
                $file->move('public/images/profile/', $fileName);
                $user->profile_pic = $fileName;
            }
            $user->save(); //remove all save
            return redirect()->back()->with('success', 'Account updated successfully');
        } else {
            return redirect()->back()->with('error', 'User data not found');
        }
    }
    public function updateMyTeacherAccount(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_birth' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'qualification' => 'required',
            'work_experience' => 'required',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'marital_status' => ['required', Rule::in(['married', 'un_married'])],
            'blood_group' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);
        $user = User::getSingleUser($id)->first();
        if (isset($user)) {
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->gender = trim($request->gender);
            $user->date_of_birth = trim($request->date_of_birth);
            $user->mobile_number = trim($request->mobile_number);
            $user->current_address = trim($request->current_address);
            $user->permanent_address = trim($request->permanent_address);
            $user->qualification = json_encode($request->qualification);
            $user->work_experience = trim($request->work_experience);
            $user->marital_status = trim($request->marital_status);
            $user->blood_group = trim($request->blood_group);
            if (!empty($request->file('profile_pic'))) {
                if (!empty($user->getProfilePic())) {
                    if (!empty($user->profile_pic) && file_exists('public/images/profile/' . $user->profile_pic)) {
                        unlink('public/images/profile/' . $user->profile_pic);
                    }
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $randomStr = Str::random(10);
                $fileName = 'tch' . strtolower($randomStr) . '.' . $ext;
                $file->move('public/images/profile/', $fileName);
                $user->profile_pic = $fileName;
            }
            $user->save(); //remove all save

            return redirect()->back()->with('success', 'Account updated successfully');
        } else {
            return redirect()->back()->with('error', 'User data not found');
        }
    }
    public function updateMyStudentAccount(UpdateStudentFormRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::getSingleUser($id)->first();
        if (isset($user)) {
            $user->update($request->validated());
            if (!empty($request->file('profile_pic'))) {
                if (!empty($user->profile_pic) && file_exists('public/images/profile/' . $user->profile_pic)) {
                    unlink('public/images/profile/' . $user->profile_pic);
                }
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $randomStr = Str::random(10);
                $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/profile/', $fileName);
                $user->profile_pic = $fileName;
            }
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->qualification = json_encode($request->qualification);
            $user->save(); //remove all save
            return redirect()->back()->with('success', 'Account updated successfully');
        } else {
            return redirect()->back()->with('error', 'User data not found');
        }
    }
}
