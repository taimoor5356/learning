<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Subjects List';
        $data['records'] = Subject::getSubjects()->paginate(25);
        return view('admin.subject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add Subject';
        return view('admin.subject.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required|string'
        ]);
        $subject = new Subject();
        $subject->name = trim($request->name);
        $subject->fees = trim($request->fees);
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save(); //remove all save
        return redirect('admin/subject/list')->with('success', 'Subject created successfully created');
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
        $data['record'] = Subject::getSingleSubject($id);
        if (isset($data['record'])) {
            $data['header_title'] = 'Edit Subject Details';
            return view('admin.subject.edit', $data);
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
            'name' => 'required|string',
        ]);
        $subject = Subject::getSingleSubject($id);
        if (isset($subject)) {
            $subject->name = trim($request->name);
            $subject->fees = trim($request->fees);
            $subject->type = $request->type;
            $subject->status = $request->status;
            $subject->created_by = Auth::user()->id;
            $subject->save(); //remove all save
            return redirect('admin/subject/list')->with('success', 'Subject updated successfully');
        } else {
            return redirect()->back()->with('error', 'Subject data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $subject = Subject::getSingleSubject($id);
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Subjects list';
        $data['records'] = Subject::getTrashedSubjects()->paginate(25);
        return view('admin.subject.trashed', $data);
    }

    public function myStudentSubjects()
    {
        //
        $data['header_title'] = 'My Subjects list';
        $classId = Auth::user()->class_id;
        $data['records'] = ClassSubject::getSingleClassSubjects($classId)->paginate(25);
        return view('student.my_subject', $data);
    }
}
