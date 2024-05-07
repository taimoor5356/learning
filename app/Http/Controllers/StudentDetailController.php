<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Students list';
        $data['records'] = User::getStudents()->paginate(3);
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add New Student';
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.student.create', $data);
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
            'admission_number' => 'required|max:50|unique:users',
            'roll_number' => 'required|max:50|unique:users',
            'class_id' => 'required|integer',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_birth' => 'required',
            'caste' => 'required',
            'religion' => 'required',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'admission_date' => 'required',
            'profile_pic' => 'required|file',
            'status' => ['required', Rule::in([0, 1])],
            'height' => 'required|regex:/^\d+(\.\d+)?$/|min:0|max:7',
            'weight' => 'required|integer|max:100',
            'blood_group' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
        ]);
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status = trim($request->status);
        $user->gender = trim($request->gender);
        $user->date_of_birth = trim($request->date_of_birth);
        $user->caste = trim($request->caste);
        $user->religion = trim($request->religion);
        $user->mobile_number = trim($request->mobile_number);
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(10);
            $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/profile/', $fileName);
            $user->profile_pic = $fileName;
        }
        $user->blood_group = trim($request->blood_group);
        $user->height = trim($request->height);
        $user->weight = trim($request->weight);
        $user->user_type = 3;
        $user->admission_number = trim($request->admission_number);
        $user->roll_number = trim($request->roll_number);
        $user->class_id = trim($request->class_id);
        $user->admission_date = trim($request->admission_date);
        $user->save();

        return redirect('admin/student/list')->with('success', 'Student added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDetail $studentDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Student Detail';
        $data['record'] = User::getSingleUser($id)->first();
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('admin.student.edit', $data);
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
            'admission_number' => 'required|max:50|unique:users,admission_number,'.$id,
            'roll_number' => 'required|max:50|unique:users,roll_number,'.$id,
            'class_id' => 'required|integer',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_birth' => 'required',
            'caste' => 'required',
            'religion' => 'required',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'admission_date' => 'required',
            'status' => ['required', Rule::in([0, 1])],
            'height' => 'required|regex:/^\d+(\.\d+)?$/|min:0|max:7',
            'weight' => 'required|integer|max:100',
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
        $user->caste = trim($request->caste);
        $user->religion = trim($request->religion);
        $user->mobile_number = trim($request->mobile_number);
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
        $user->blood_group = trim($request->blood_group);
        $user->height = trim($request->height);
        $user->weight = trim($request->weight);
        $user->admission_number = trim($request->admission_number);
        $user->roll_number = trim($request->roll_number);
        $user->class_id = trim($request->class_id);
        $user->admission_date = trim($request->admission_date);
        $user->save();

        return redirect('admin/student/list')->with('success', 'Student details updated successfully');
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
            return redirect('admin/student/list')->with('success', 'Student deleted successfully');
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
        $data['header_title'] = 'Trashed Students list';
        $data['records'] = User::getTrashedStudents()->paginate(10);
        return view('admin.student.trashed', $data);
    }

    public function myTeacherStudents()
    {
        $data['header_title'] = 'My Students List';
        $data['records'] = User::getTeacherStudents(Auth::user()->id)->paginate(10);
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('teacher.student.index', $data);
    }
}
