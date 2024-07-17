<?php

namespace App\Http\Controllers;

use App\Models\ClassTeacher;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    //
    public function index() 
    {
        $data['header_title'] = 'Assigned Class Teacher List';
        $data['records'] = ClassTeacher::getClassTeachers()->paginate(25);
        return view('admin.assign_class_teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Assign Teacher a Subject';
        $data['batches'] = SchoolClass::getClasses()->get();
        $data['teachers'] = User::getTeachers()->get();
        return view('admin.assign_class_teacher.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'class_id' => 'required',
            'teacher_id' => 'required'
        ]);
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher) {
                $getSingleAlreadyAssigned = ClassTeacher::getSingleAlreadyAssigned($request->class_id, $teacher);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == $request->status;
                    $getSingleAlreadyAssigned->save(); //remove all save
                } else {
                    $classTeacher = new ClassTeacher();
                    $classTeacher->batch_id = $request->class_id;
                    $classTeacher->class_id = $request->class_id;
                    $classTeacher->teacher_id = $teacher;
                    $classTeacher->created_by = Auth::user()->id;
                    $classTeacher->status = $request->status;
                    $classTeacher->save(); //remove all save
                }
            }
            return redirect('admin/class-teacher/list')->with('success', 'Teacher assigned successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['header_title'] = 'Edit Assigned Class Teacher';
        $data['record'] = ClassTeacher::getSingleClassTeacher($id);
        if (isset($data['record'])) {
            $data['classes'] = SchoolClass::getClasses()->get();
            $data['teachers'] = User::getTeachers()->get();
            $data['getAssignedTeacherId'] = ClassTeacher::getAssignedTeacherId($data['record']->class_id)->get();
            $data['header_title'] = 'Edit Assigned Teacher Details';
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSingle(string $id)
    {
        //
        $data['header_title'] = 'Edit Single Assigned Class Teacher';
        $data['record'] = ClassTeacher::getSingleClassTeacher($id);
        if (isset($data['record'])) {
            $data['classes'] = SchoolClass::getClasses()->get();
            $data['teachers'] = User::getTeachers()->get();
            $data['header_title'] = 'Edit Assigned Teacher Details';
            return view('admin.assign_class_teacher.edit_single', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'class_id' => 'required',
            'teacher_id' => 'required'
        ]);
        // first delete the class Teacher
        ClassTeacher::getAssignedTeacherId($request->class_id)->forceDelete();
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher) {
                $getSingleAlreadyAssigned = ClassTeacher::getSingleAlreadyAssigned($request->class_id, $teacher);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == $request->status;
                    $getSingleAlreadyAssigned->save(); //remove all save
                } else {
                    $classTeacher = new ClassTeacher();
                    $classTeacher->class_id = $request->class_id;
                    $classTeacher->teacher_id = $teacher;
                    $classTeacher->created_by = Auth::user()->id;
                    $classTeacher->status = $request->status;
                    $classTeacher->save(); //remove all save
                }
            }
            return redirect('admin/class-teacher/list')->with('success', 'Teacher assigned successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSingle(Request $request, $id)
    {
        //
        request()->validate([
            'class_id' => 'required',
            'teacher_id' => 'required'
        ]);
        $getSingleAlreadyAssigned = ClassTeacher::getSingleAlreadyAssigned($request->class_id, $request->teacher_id);
        if (isset($getSingleAlreadyAssigned)) {
            $getSingleAlreadyAssigned->status = $request->status;
            $getSingleAlreadyAssigned->save(); //remove all save
            return redirect('admin/class-teacher/list')->with('success', 'Status updated successfully');
        } else {
            $classTeacher = ClassTeacher::getSingleClassTeacher($id);
            $classTeacher->class_id = $request->class_id;
            $classTeacher->teacher_id = $request->teacher_id;
            $classTeacher->created_by = Auth::user()->id;
            $classTeacher->status = $request->status;
            $classTeacher->save(); //remove all save
        }
        return redirect('admin/class-teacher/list')->with('success', 'Teacher assigned successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $teacher = ClassTeacher::getSingleClassTeacher($id);
        $teacher->delete();
        return redirect()->back()->with('success', 'Assigned Subject deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Assigned Subject list';
        $data['records'] = ClassTeacher::getTrashedClassSubjects()->paginate(25);
        return view('admin.assign_class_teacher.trashed', $data);
    }

    public function myTeacherClassSubjects()
    {
        //
        $data['header_title'] = 'My Subjects list';
        $teacherId = Auth::user()->id;
        $batchId = Auth::user()->batch_id;
        $data['subjects'] = ClassTeacher::getMyClassSubjects($batchId, $teacherId);
        $data['records'] = TeacherSubject::getSingleTeacherWiseSubjects($teacherId)->paginate(25);
        return view('teacher.my_subject', $data);
    }
}
