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
        if (!empty($request->qualification)) {
            $user->qualification = json_encode($request->qualification);
        }
        $user->user_type = 3;
        // $user->status = 1;
        $user->save();
        $user->password = Hash::make('12345678');
        if (!empty($request->roll_number)) {
            $user->roll_number = $request->roll_number.$user->id;
        }
        $user->admission_number = Str::random(5).$user->id;
        $user->save();
        return redirect('admin/student/list')->with('success', 'Student added successfully');
    }

    public function storeVisitor(Request $request)
    {
        request()->validate([
            'class_type' => ['required', Rule::in(['on_campus', 'online'])],
            'class_program' => ['required', Rule::in(['css', 'pms', 'examination', 'interview', 'others'])],
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'gender' => ['required', Rule::in(['male', 'female'])],
            // 'qualification' => 'required',
            'domicile' => ['required', Rule::in(['isb', 'punjab', 'sindh', 'balochistan', 'kpk'])],
        ]);
        if (Auth::user()) {
            $user = User::getSingleUser(Auth::user()->id)->first();
            $user = $user;
        } else {
            $user = new User();
        }
        $user->class_type = trim($request->class_type);
        $user->user_type = 10;
        $user->class_program = trim($request->class_program);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->mobile_number = trim($request->mobile_number);
        $user->gender = trim($request->gender);
        $user->status = 0;
        if (!empty($request->qualification)) {
            $user->qualification = json_encode($request->qualification);
        }
        $user->domicile = trim($request->domicile);
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
        $data['id'] = $id;
        $data['record'] = User::getSingleUser($id)->first();
        $data['paid_amount'] = User::submitted_fee($id, $data['record']->class_id)->sum('paid_amount');
        $data['remaining_dues'] = User::submitted_fee($id, $data['record']->class_id)->sum('remaining_amount');
        $paymentMethod = User::submitted_fee($id, $data['record']->class_id)->first();
        $data['payment_method'] = isset($paymentMethod) ? $paymentMethod->payment_type : '';
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
            if (!empty($request->qualification)) {
                $user->qualification = json_encode($request->qualification);
            }
            if (empty($user->password)) {
                $user->password = Hash::make('12345678');
            }
            if (empty($user->admission_number)) {
                $user->admission_number = Str::random(5).$id;
            }
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
        $data['records'] = User::getTrashedStudents()->paginate(25);
        return view('admin.student.trashed', $data);
    }

    public function myTeacherStudents()
    {
        $data['header_title'] = 'My Students List';
        $data['records'] = User::getTeacherStudents(Auth::user()->id)->paginate(25);
        $data['classes'] = SchoolClass::getClasses()->get();
        return view('teacher.student.index', $data);
    }
}
