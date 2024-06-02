<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\HomeWork;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\SubmittedHomeWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class HomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Home Work';
        $data['records'] = HomeWork::getAllHomeWork()->paginate(25);
        return view('admin.home_work.index', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function submittedHomeWorkList()
    {
        //
        $data['header_title'] = 'Submitted Home Work List';
        $homeWork = HomeWork::getSingleHomeWork(1)->first();
        $data['records'] = SubmittedHomeWork::getHomeWorkList()->paginate(25);
        return view('admin.home_work.submitted_list', $data);
        if (isset($homeWork)) {
            $data['records'] = SubmittedHomeWork::getHomeWorkList()->paginate(25);
            return view('admin.home_work.submitted_list', $data);
        } else {
            return redirect('admin/home-work/list')->with('error', 'Home Work Not Found');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function submittedHomeWork($id)
    {
        //
        $data['header_title'] = 'Home Work';
        $homeWork = HomeWork::getSingleHomeWork($id)->first();
        if (isset($homeWork)) {
            $data['records'] = SubmittedHomeWork::getSingleSubmittedHomeWork($id)->paginate(25);
            return view('admin.home_work.submitted', $data);
        } else {
            return redirect()->route('home_work.index')->with('error', 'Home Work Not Found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['header_title'] = 'Add New Home Work';
        return view('admin.home_work.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $homeWork = new HomeWork();
            $homeWork->batch_id = $request->class_id;
            $homeWork->class_id = $request->class_id;
            $homeWork->subject_id = $request->subject_id;
            $homeWork->homework_date = $request->homework_date;
            $homeWork->submission_date = $request->submission_date;
            $homeWork->description = $request->message;
            $homeWork->created_by = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $homeWork->document = $fileName;
            }
            $homeWork->save(); //remove all save
            return redirect('admin/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeWork $homeWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Home Work';
        $data['record'] = HomeWork::getSingleHomeWork($id)->first();
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['subjects'] = ClassSubject::getSingleClassSubjects($data['record']->class_id)->get();
        if (isset($data['record'])) {
            return view('admin.home_work.edit', $data);
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $homeWork = HomeWork::getSingleHomeWork($id)->first();
            if (!isset($homeWork)) {
                $homeWork = new HomeWork();
            }
            $homeWork->batch_id = $request->class_id;
            $homeWork->class_id = $request->class_id;
            $homeWork->subject_id = $request->subject_id;
            $homeWork->homework_date = $request->homework_date;
            $homeWork->submission_date = $request->submission_date;
            $homeWork->description = $request->message;
            $homeWork->created_by = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                if (!empty($homeWork->getDocument())) {
                    // unlink('public/images/howework/'.$homeWork->document);
                }
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $homeWork->document = $fileName;
            }
            $homeWork->save(); //remove all save
            return redirect('admin/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $homeWork = HomeWork::getSingleHomeWork($id);
        if (isset($homeWork)) {
            $homeWork->delete();
            return redirect('admin/home-work/list')->with('success', 'Home work deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Home Work';
        $data['records'] = HomeWork::getAllTrashedHomeWork()->paginate(25);
        return view('admin.home_work.trashed', $data);
    }

    public function getClassSubjects(Request $request)
    {
        $classId = $request->class_id;
        $classSubjects = ClassSubject::getSingleClassSubjects($classId)->get();
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach ($classSubjects as $classSubject) {
            $html.= '<option value="'. $classSubject->subject_id. '">'. $classSubject->subject?->name. '</option>';
        }
        return response()->json([
            'status', true,
            'subjects' => $html
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function teacherHomeWork()
    {
        //
        $data['header_title'] = 'Home Work';
        $classIds = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->pluck('class_id');
        $data['records'] = HomeWork::getAllTeacherHomeWork($classIds)->paginate(25);
        return view('teacher.home_work.index', $data);
    }
    /**
     * Display a listing of the resource.
     */
    public function createTeacherHomeWork()
    {
        //
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $data['header_title'] = 'Add New Home Work';
        return view('teacher.home_work.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTeacherHomeWork(Request $request)
    {
        //
        try {
            $homeWork = new HomeWork();
            $homeWork->class_id = $request->class_id;
            $homeWork->subject_id = $request->subject_id;
            $homeWork->homework_date = $request->homework_date;
            $homeWork->submission_date = $request->submission_date;
            $homeWork->description = $request->message;
            $homeWork->created_by = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $homeWork->document = $fileName;
            }
            $homeWork->save(); //remove all save
            return redirect('teacher/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTeacherHomeWork($id)
    {
        //
        $data['header_title'] = 'Edit Home Work';
        $data['record'] = HomeWork::getSingleHomeWork($id)->first();
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $data['subjects'] = ClassSubject::getSingleClassSubjects($data['record']->class_id)->get();
        if (isset($data['record'])) {
            return view('teacher.home_work.edit', $data);
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTeacherHomeWork(Request $request, $id)
    {
        //
        try {
            $homeWork = HomeWork::getSingleHomeWork($id)->first();
            if (!isset($homeWork)) {
                $homeWork = new HomeWork();
            }
            $homeWork->class_id = $request->class_id;
            $homeWork->subject_id = $request->subject_id;
            $homeWork->homework_date = $request->homework_date;
            $homeWork->submission_date = $request->submission_date;
            $homeWork->description = $request->message;
            $homeWork->created_by = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                if (!empty($homeWork->getDocument())) {
                    // unlink('public/images/howework/'.$homeWork->document);
                }
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $homeWork->document = $fileName;
            }
            $homeWork->save(); //remove all save
            return redirect('teacher/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyTeacherHomeWork($id)
    {
        //
        $homeWork = HomeWork::getSingleHomeWork($id);
        if (isset($homeWork)) {
            $homeWork->delete();
            return redirect('teacher/home-work/list')->with('success', 'Home work deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function trashedTeacherHomeWork()
    {
        //
        // $data['header_title'] = 'Trashed Home Work';
        // $data['records'] = HomeWork::getAllTeacherTrashedHomeWork()->paginate(25);
        // return view('teacher.home_work.trashed', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function studentHomeWork()
    {
        //
        $data['header_title'] = 'Home Work';
        $data['records'] = HomeWork::getAllStudentHomeWork(Auth::user()->class_id, Auth::user()->id)->paginate(25);
        return view('student.home_work.index', $data);
    }
    /**
     * Display a listing of the resource.
     */
    public function createStudentHomeWork($id)
    {
        //
        $data['records'] = HomeWork::getSingleHomeWork($id)->first();
        $data['id'] = $id;
        $data['header_title'] = 'Submit Home Work';
        return view('student.home_work.create', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function submittedStudentHomeWork(Request $request)
    {
        //
        $data['records'] = SubmittedHomeWork::getStudentSubmittedHomeWork(Auth::user()->id)->paginate(25);
        $data['header_title'] = 'Submit Home Work';
        return view('student.home_work.submitted', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeStudentHomeWork(Request $request, $id)
    {
        //
        try {
            $submittedHomeWork = new SubmittedHomeWork();
            $submittedHomeWork->homework_id = $id;
            $submittedHomeWork->description = $request->message;
            $submittedHomeWork->user_id = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $submittedHomeWork->document = $fileName;
            }
            $submittedHomeWork->save(); //remove all save
            return redirect('student/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStudentHomeWork($id)
    {
        //
        $data['header_title'] = 'Edit Home Work';
        $data['record'] = HomeWork::getSingleHomeWork($id)->first();
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $data['subjects'] = ClassSubject::getSingleClassSubjects($data['record']->class_id)->get();
        if (isset($data['record'])) {
            return view('student.home_work.edit', $data);
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudentHomeWork(Request $request, $id)
    {
        //
        try {
            $homeWork = HomeWork::getSingleHomeWork($id)->first();
            if (!isset($homeWork)) {
                $homeWork = new HomeWork();
            }
            $homeWork->class_id = $request->class_id;
            $homeWork->subject_id = $request->subject_id;
            $homeWork->homework_date = $request->homework_date;
            $homeWork->submission_date = $request->submission_date;
            $homeWork->description = $request->message;
            $homeWork->created_by = Auth::user()->id;
            //upload file
            if (!empty($request->file('document'))) {
                if (!empty($homeWork->getDocument())) {
                    // unlink('public/images/howework/'.$homeWork->document);
                }
                $ext = $request->file('document')->getClientOriginalExtension();
                $file = $request->file('document');
                $randomStr = Str::random(10);
                $fileName = 'hw' . strtolower($randomStr). '.'. $ext;
                $file->move('public/images/homework/', $fileName);
                $homeWork->document = $fileName;
            }
            $homeWork->save(); //remove all save
            return redirect('student/home-work/list')->with('success', 'Home work submitted successfully');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyStudentHomeWork($id)
    {
        //
        $homeWork = HomeWork::getSingleHomeWork($id);
        if (isset($homeWork)) {
            $homeWork->delete();
            return redirect('student/home-work/list')->with('success', 'Home work deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Home work not found');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function trashedStudentHomeWork()
    {
        //
        // $data['header_title'] = 'Trashed Home Work';
        // $data['records'] = HomeWork::getAllTeacherTrashedHomeWork()->paginate(25);
        // return view('student.home_work.trashed', $data);
    }
}
