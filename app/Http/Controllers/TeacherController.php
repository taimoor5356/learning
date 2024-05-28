<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\TeacherDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Teachers List';
        $data['records'] = User::getTeachers()->paginate(25);
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add New Teacher Detail';
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.teacher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'profile_pic' => 'required|file',
            'date_of_birth' => 'required',
            'admission_date' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'qualification' => 'required',
            'work_experience' => 'required',
            'note' => 'required',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'marital_status' => ['required', Rule::in(['married', 'un_married'])],
            'status' => ['required', Rule::in([0, 1])],
            'blood_group' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status = trim($request->status);
        $user->gender = trim($request->gender);
        $user->admission_date = trim($request->admission_date);
        $user->date_of_birth = trim($request->date_of_birth);
        $user->mobile_number = trim($request->mobile_number);
        $user->current_address = trim($request->current_address);
        $user->permanent_address = trim($request->permanent_address);
        if (!empty($request->qualification)) {
            $user->qualification = json_encode($request->qualification);
        }
        $user->work_experience = trim($request->work_experience);
        $user->note = trim($request->note);
        $user->marital_status = trim($request->marital_status);
        $user->blood_group = trim($request->blood_group);
        $user->user_type = 2;
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(10);
            $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/profile/', $fileName);
            $user->profile_pic = $fileName;
        }
        $user->save(); //remove all save

        return redirect('admin/teacher/list')->with('success', 'Teacher added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Teacher Detail';
        $data['record'] = User::getSingleUser($id)->first();
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.teacher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email,'.$id,
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_birth' => 'required',
            'admission_date' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'qualification' => 'required',
            'work_experience' => 'required',
            'note' => 'required',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'marital_status' => ['required', Rule::in(['married', 'un_married'])],
            'status' => ['required', Rule::in([0, 1])],
            'blood_group' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);
        $user = User::getSingleUser($id)->first();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = trim($request->status);
        $user->gender = trim($request->gender);
        $user->date_of_birth = trim($request->date_of_birth);
        $user->admission_date = trim($request->admission_date);
        $user->mobile_number = trim($request->mobile_number);
        $user->current_address = trim($request->current_address);
        $user->permanent_address = trim($request->permanent_address);
        if (!empty($request->qualification)) {
            $user->qualification = json_encode($request->qualification);
        }
        $user->work_experience = trim($request->work_experience);
        $user->note = trim($request->note);
        $user->marital_status = trim($request->marital_status);
        $user->blood_group = trim($request->blood_group);
        if (!empty($request->file('profile_pic'))) {
            if (file_exists('public/images/profile/'.$user->profile_pic)) {
                        unlink('public/images/profile/'.$user->profile_pic);
                    }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(10);
            $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/profile/', $fileName);
            $user->profile_pic = $fileName;
        }
        $user->save(); //remove all save

        return redirect('admin/teacher/list')->with('success', 'Teacher details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::getSingleUser($id)->first();
        if (isset($user)) {
            $user->delete();
            return redirect('admin/teacher/list')->with('success', 'Teacher deleted successfully');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Teachers list';
        $data['records'] = User::getTrashedTeachers()->paginate(25);
        return view('admin.teacher.trashed', $data);
    }
}
