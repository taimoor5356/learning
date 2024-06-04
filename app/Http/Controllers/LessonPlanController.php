<?php

namespace App\Http\Controllers;

use App\Models\LessonPlan;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $data['header_title'] = 'Lesson Plan';
        $data['id'] = $id;
        $data['records'] = LessonPlan::getLessonPlans($id)->paginate(25);
        return view('admin.lesson_plan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $data['header_title'] = 'Add Lesson Plan';
        $data['id'] = $id;
        return view('admin.lesson_plan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //
        $subject = Subject::getSingleSubject($id);
        if (isset($subject)) {
            $lessonPlan = new LessonPlan();
            // $lessonPlan->batch_id = $id;
            $lessonPlan->subject_id = $id;
            $lessonPlan->lesson_plan = $request->lesson_plan;
            $lessonPlan->description = $request->description;
            $lessonPlan->status = $request->status;
            // $lessonPlan->teacher_id = $request->teacher_id;
            $lessonPlan->created_by = Auth::user()->id;
            $lessonPlan->save();
            return redirect('admin/lesson-plan/list/' . $id)->with('success', 'Successfully added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonPlan $lessonPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Lesson Plan';
        $data['id'] = $id;
        $data['record'] = LessonPlan::find($id);
        if (isset($data['record'])) {
            return view('admin.lesson_plan.edit', $data);
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
        $lessonPlan = LessonPlan::where('id', $id)->first();
        if (isset($lessonPlan)) {
            $lessonPlan->lesson_plan = $request->lesson_plan;
            $lessonPlan->description = $request->description;
            $lessonPlan->status = $request->status;
            $lessonPlan->save();
            return redirect('admin/lesson-plan/list/' . $lessonPlan->subject_id)->with('success', 'Successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LessonPlan $lessonPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function statusUpdate($status, $id)
    {
        //
        $lessonPlan = LessonPlan::where('id', $id)->first();
        if (isset($lessonPlan)) {
            $lessonPlan->status = $status;
            $lessonPlan->created_by = Auth::user()->id;
            $lessonPlan->save();
            return redirect()->back()->with('success', 'Successfully updated');
        } else {
            abort(404);
        }
    }
}
