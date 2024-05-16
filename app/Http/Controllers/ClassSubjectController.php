<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Class Teachers List';
        $data['records'] = ClassSubject::getClassSubjects()->paginate(25);
        return view('admin.class_subject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Assign Subject';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['subjects'] = Subject::getSubjects()->get();
        return view('admin.class_subject.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'class_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject) {
                $getSingleAlreadyAssigned = ClassSubject::getSingleAlreadyAssigned($request->class_id, $subject);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == $request->status;
                    $getSingleAlreadyAssigned->save();
                } else {
                    $class_subject = new ClassSubject();
                    $class_subject->class_id = $request->class_id;
                    $class_subject->subject_id = $subject;
                    $class_subject->created_by = Auth::user()->id;
                    $class_subject->status = $request->status;
                    $class_subject->save();
                }
            }
            return redirect('admin/class-subject/list')->with('success', 'Subject assigned successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
    public function edit(string $id)
    {
        //
        $data['header_title'] = 'Edit Assigned Class Subject';
        $data['record'] = ClassSubject::getSingleClassSubject($id);
        if (isset($data['record'])) {
            $data['classes'] = SchoolClass::getClasses()->get();
            $data['subjects'] = Subject::getSubjects()->get();
            $data['getAssignedSubjectId'] = ClassSubject::getAssignedSubjectId($data['record']->class_id)->get();
            $data['header_title'] = 'Edit Assigned Subject Details';
            return view('admin.class_subject.edit', $data);
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
        $data['header_title'] = 'Edit Single Assigned Class Subject';
        $data['record'] = ClassSubject::getSingleClassSubject($id);
        if (isset($data['record'])) {
            $data['classes'] = SchoolClass::getClasses()->get();
            $data['subjects'] = Subject::getSubjects()->get();
            $data['header_title'] = 'Edit Assigned Subject Details';
            return view('admin.class_subject.edit_single', $data);
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
            'subject_id' => 'required'
        ]);
        // first delete the class subject
        ClassSubject::getAssignedSubjectId($request->class_id)->forceDelete();
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject) {
                $getSingleAlreadyAssigned = ClassSubject::getSingleAlreadyAssigned($request->class_id, $subject);
                if (!empty($getSingleAlreadyAssigned)) {
                    $getSingleAlreadyAssigned->status == $request->status;
                    $getSingleAlreadyAssigned->save();
                } else {
                    $class_subject = new ClassSubject();
                    $class_subject->class_id = $request->class_id;
                    $class_subject->subject_id = $subject;
                    $class_subject->created_by = Auth::user()->id;
                    $class_subject->status = $request->status;
                    $class_subject->save();
                }
            }
            return redirect('admin/class-subject/list')->with('success', 'Subject assigned successfully');
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
            'subject_id' => 'required'
        ]);
        $getSingleAlreadyAssigned = ClassSubject::getSingleAlreadyAssigned($request->class_id, $request->subject_id);
        if (isset($getSingleAlreadyAssigned)) {
            $getSingleAlreadyAssigned->status = $request->status;
            $getSingleAlreadyAssigned->save();
            return redirect('admin/class-subject/list')->with('success', 'Status updated successfully');
        } else {
            $class_subject = ClassSubject::getSingleClassSubject($id);
            $class_subject->class_id = $request->class_id;
            $class_subject->subject_id = $request->subject_id;
            $class_subject->created_by = Auth::user()->id;
            $class_subject->status = $request->status;
            $class_subject->save();
        }
        return redirect('admin/class-subject/list')->with('success', 'Subject assigned successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $subject = ClassSubject::getSingleClassSubject($id);
        $subject->delete();
        return redirect()->back()->with('success', 'Assigned Subject deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Assigned Subject list';
        $data['records'] = ClassSubject::getTrashedClassSubjects()->paginate(25);
        return view('admin.class_subject.trashed', $data);
    }
}
