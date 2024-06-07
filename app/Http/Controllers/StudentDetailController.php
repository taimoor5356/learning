<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentFormRequest;
use App\Http\Requests\UpdateStudentFormRequest;
use App\Mail\ForgotPasswordMail;
use App\Mail\SendPasswordMail;
use App\Models\ClassSubject;
use App\Models\Examination;
use App\Models\SchoolClass;
use App\Models\StudentDetail;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $data['batches'] = SchoolClass::getClasses()->get();
        $data['exams'] = Examination::getExams()->get();
        return view('admin.student.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentFormRequest $request)
    {
        //
        try {
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
            $user->save(); //remove all save
            $userPassword = Str::random(10);
            $user->password = Hash::make($userPassword);
            if (!empty($request->roll_number)) {
                $user->roll_number = $request->roll_number.$user->id;
            }
            $user->admission_number = Str::random(5).$user->id;
            $studentSubjects = $request->subject_id;
            $user->subjects = json_encode($studentSubjects);
            $user->total_fees = $request->total_fee;
            $user->save(); //remove all save
            foreach ($studentSubjects as $key => $subject) {
                $getSingleAlreadyAssigned = ClassSubject::getSingleAlreadyAssigned($request->batch_number, $subject);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == 1;
                    $getSingleAlreadyAssigned->save(); //remove all save
                } else {
                    $class_subject = new ClassSubject();
                    $class_subject->batch_id = $request->batch_number;
                    $class_subject->class_id = $request->batch_number;
                    $class_subject->subject_id = $subject;
                    $class_subject->created_by = Auth::user()->id;
                    $class_subject->status = 1;
                    $class_subject->save(); //remove all save
                }
                $alreadyAssignedSubject = StudentSubject::alreadyAssigned($user->id, $request->batch_number, $subject);
                if (!empty($alreadyAssignedSubject)) {
                    $alreadyAssignedSubject->status == 1;
                    $alreadyAssignedSubject->save(); //remove all save
                } else {
                    $studentSubject = new StudentSubject();
                    $studentSubject->user_id = $user->id;
                    $studentSubject->batch_id = $request->batch_number;
                    $studentSubject->subject_id = $subject;
                    $studentSubject->created_by = Auth::user()->id;
                    $studentSubject->status = 1;
                    $studentSubject->save(); //remove all save
                }
            }
            Mail::to($user->email)->send(new SendPasswordMail($user, $userPassword));
            return redirect('admin/student/list')->with('success', 'Student added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
        $user->save(); //remove all save

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
        $data['paid_amount'] = User::submitted_fee($id, $data['record']->batch_number)->sum('paid_amount');
        $data['remaining_dues'] = User::submitted_fee($id, $data['record']->batch_number)->sum('remaining_amount');
        $paymentMethod = User::submitted_fee($id, $data['record']->batch_number)->first();
        $data['payment_method'] = isset($paymentMethod) ? $paymentMethod->payment_type : '';
        $data['batches'] = SchoolClass::getClasses()->get();
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
            if (!empty($request->roll_number)) {
                $user->roll_number = $request->roll_number.$user->id;
            }
            // if (!empty($request->send_password_email)) {
            //     $userPassword = Str::random(10);
            //     $user->password = Hash::make($userPassword);
            //     Mail::to($user->email)->send(new SendPasswordMail($user, $userPassword));
            // }
            $studentSubjects = $request->subject_id;
            $user->subjects = json_encode($studentSubjects);
            $user->total_fees = $request->total_fee;
            $user->save(); //remove all save
            StudentSubject::where('user_id', $user->id)->where('batch_id', $request->batch_number)->forceDelete();
            foreach ($studentSubjects as $key => $subject) {
                $getSingleAlreadyAssigned = ClassSubject::getSingleAlreadyAssigned($request->batch_number, $subject);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == 1;
                    $getSingleAlreadyAssigned->save(); //remove all save
                } else {
                    $class_subject = new ClassSubject();
                    $class_subject->batch_id = $request->batch_number;
                    $class_subject->class_id = $request->batch_number;
                    $class_subject->subject_id = $subject;
                    $class_subject->created_by = Auth::user()->id;
                    $class_subject->status = 1;
                    $class_subject->save(); //remove all save
                }
                $alreadyAssignedSubject = StudentSubject::alreadyAssigned($user->id, $request->batch_number, $subject);
                if (!empty($alreadyAssignedSubject)) {
                    $alreadyAssignedSubject->status == 1;
                    $alreadyAssignedSubject->save(); //remove all save
                } else {
                    $studentSubject = new StudentSubject();
                    $studentSubject->user_id = $user->id;
                    $studentSubject->batch_id = $request->batch_number;
                    $studentSubject->subject_id = $subject;
                    $studentSubject->created_by = Auth::user()->id;
                    $studentSubject->status = 1;
                    $studentSubject->save(); //remove all save
                }
            }
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

    public function selectSubjectTypes(Request $request)
    {
        if (!empty($request->subject_type)) {
            $subjects = Subject::query();
            if ($request->subject_type == 'english_essay_and_precis') {
                $subjects = $subjects->where('name', 'LIKE', '%english%');
            } elseif ($request->subject_type == 'compulsory_only') {
                $subjects = $subjects->where('type', '=', 'compulsory');
            } elseif ($request->subject_type == 'optional_only') {
                $subjects = $subjects->where('type', '=', 'optional');
            } elseif ($request->subject_type == 'all') {
                $subjects = $subjects;
            } elseif ($request->subject_type == 'custom') {
                $subjects = $subjects;
            }
            return response()->json(array('subjects' => $subjects->get()));
        }
    }
}
