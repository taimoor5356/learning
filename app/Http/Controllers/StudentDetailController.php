<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentFormRequest;
use App\Http\Requests\UpdateStudentFormRequest;
use App\Models\Examination;
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
        $data['records'] = User::getStudents()->paginate(25);
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
        $data['exams'] = Examination::getExams()->get();
        return view('admin.student.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentFormRequest $request)
    {
        //
        $user = User::create($request->validated());
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(10);
            $fileName = 'stu' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/profile/', $fileName);
            $user->profile_pic = $fileName;
        }
        $user->qualification = json_encode([$request->qualification]);
        $user->user_type = 3;
        $user->status = 1;
        $user->save();
        return redirect('admin/student/list')->with('success', 'Student added successfully');
    }

    public function storeVisitor(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'class_type' => ['required', Rule::in(['on_campus', 'online'])],
            'class_program' => ['required', Rule::in(['css', 'pms', 'examination', 'interview', 'others'])],
            'domicile' => ['required', Rule::in(['isb', 'punjab', 'sindh', 'balochistan', 'kpk'])],
            'qualification' => 'required',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'mobile_number' => 'required|min_digits:10|max_digits:15',
        ]);
        $user = User::getSingleUser(Auth::user()->id)->first();
        if (isset($user)) {
            $user = $user;
        } else {
            $user = new User();
        }
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
        $user->blood_group = trim($request->blood_group);
        $user->height = trim($request->height);
        $user->weight = trim($request->weight);
        $user->address = trim($request->address);
        $user->admission_date = trim($request->admission_date);
        $user->admission_number = trim($request->admission_number);
        $user->roll_number = trim($request->roll_number);
        $user->class_id = trim($request->class_id);
        $user->batch_starting_date = trim($request->batch_starting_date);
        $user->class_type = trim($request->class_type);
        $user->class_program = trim($request->class_program);
        $user->batch_number = trim($request->batch_number);
        $user->interview_type = trim($request->interview_type);
        $user->exam_id = trim($request->exam_id);
        $user->discounted_amount = trim($request->discounted_amount);
        $user->discount_reason = trim($request->discount_reason);
        $user->freeze_date = trim($request->freeze_date);
        $user->left_date = trim($request->left_date);
        $user->save();

        return redirect('')->with('success', 'Updated successfully');
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
        $data['exams'] = Examination::getExams()->get();
        return view('admin.student.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentFormRequest $request, $id)
    {
        //
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
            $user->qualification = json_encode([$request->qualification]);
            $user->save();
            return redirect('admin/student/list')->with('success', 'Student details updated successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
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
