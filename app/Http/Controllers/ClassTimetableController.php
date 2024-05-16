<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassSubjectTimetable;
use App\Models\ClassTimetable;
use App\Models\DaysOfWeek;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data['header_title'] = 'Class Timetable';
        $data['classes'] = SchoolClass::getClasses()->get();
        if (!(empty($request->class_id))) {
            $data['classSubjects'] = ClassSubject::getSingleClassSubjects($request->class_id)->get();
        }
        $daysOfWeek = DaysOfWeek::getWeekDays();
        $wDays = [];
        foreach ($daysOfWeek as $key => $day) {
            $wData = [];
            $wData['week_id'] = $day->id;
            $wData['week_name'] = $day->name;
            if (!(empty($request->class_id)) && !(empty($request->subject_id))) {
                $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($request->class_id, $request->subject_id, $day->id)->first();
                if (isset($classSubjectsRecord)) {
                    $wData['start_time'] = $classSubjectsRecord->start_time;
                    $wData['end_time'] = $classSubjectsRecord->end_time;
                    $wData['room_number'] = $classSubjectsRecord->room_number;
                } else {
                    $wData['start_time'] = '';
                    $wData['end_time'] = '';
                    $wData['room_number'] = '';
                }
            } else {
                $wData['start_time'] = '';
                $wData['end_time'] = '';
                $wData['room_number'] = '';
            }
            $wDays[] = $wData;
        }
        $data['weekDays'] = $wDays;
        $data['records'] = SchoolClass::getClasses()->paginate(25);
        return view('admin.timetable.index', $data);
    }

    public function getClassSubjects(Request $request)
    {
        $data['classSubjects'] = ClassSubject::getSingleClassSubjects($request->class_id)->get();
        $html = "<option value=''>Select Subject</option>";
        foreach ($data['classSubjects'] as $classSubject) {
            $html .= "<option value='" . $classSubject->subject_id . "'>" . $classSubject->subject->name . "</option>";
        }
        $response = $html;
        echo json_encode($response);
        // return response()->json(array('classSubjects' => $data['classSubjects']));
    }

    public function insertOrUpdate(Request $request)
    {
        // delete if already assigned
        ClassSubjectTimetable::alreadyAssignedClassTimetable($request['class_id'], $request['subject_id'])->delete();
        foreach ($request->timetable as $key => $timeTable) {
            if (!empty($timeTable['week_days_id']) && !empty($timeTable['start_time']) && !empty($timeTable['end_time']) && !empty($timeTable['room_number'])) {
                $classTimetable = new ClassSubjectTimetable();
                $classTimetable->class_id = $request['class_id'];
                $classTimetable->subject_id = $request['subject_id'];
                $classTimetable->week_days_id = $timeTable['week_days_id'];
                $classTimetable->start_time = $timeTable['start_time'];
                $classTimetable->end_time = $timeTable['end_time'];
                $classTimetable->room_number = $timeTable['room_number'];
                $classTimetable->save();
            }
        }
        return redirect()->back()->with('success', 'Class Timetable Updated Successfully');
    }

    public function myStudentTimetable(Request $request)
    {
        $data['header_title'] = 'My Timetable';
        $result = [];
        $getMySubjects = ClassSubject::getSingleClassSubjects(Auth::user()->class_id)->get();
        foreach ($getMySubjects as $key => $mySubject) {
            $dataSubject['subject_name'] = $mySubject->subject->name;
            $daysOfWeek = DaysOfWeek::getWeekDays();
            $weekDays = [];
            foreach ($daysOfWeek as $day) {
                $wData = [];
                $wData['week_id'] = $day->id;
                $wData['day_name'] = $day->name;
                $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($mySubject->class_id, $mySubject->subject_id, $day->id)->first();
                if (isset($classSubjectsRecord)) {
                    $wData['start_time'] = $classSubjectsRecord->start_time;
                    $wData['end_time'] = $classSubjectsRecord->end_time;
                    $wData['room_number'] = $classSubjectsRecord->room_number;
                } else {
                    $wData['start_time'] = '';
                    $wData['end_time'] = '';
                    $wData['room_number'] = '';
                }
                $weekDays[] = $wData;
            }
            $dataSubject['week_days'] = $weekDays;
            $result[] = $dataSubject;
        }
        $data['records'] = $result;
        return view('student.timetable.index', $data);
    }

    public function myTeacherTimetableList(Request $request)
    {
        $data['header_title'] = 'My Timetable';
        $result = [];
        $getMySubjects = ClassSubject::getSingleClassSubjects(Auth::user()->class_id)->get();
        foreach ($getMySubjects as $key => $mySubject) {
            $dataSubject['subject_name'] = $mySubject->subject->name;
            $daysOfWeek = DaysOfWeek::getWeekDays();
            $weekDays = [];
            foreach ($daysOfWeek as $day) {
                $wData = [];
                $wData['week_id'] = $day->id;
                $wData['day_name'] = $day->name;
                $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($mySubject->class_id, $mySubject->subject_id, $day->id)->first();
                if (isset($classSubjectsRecord)) {
                    $wData['start_time'] = $classSubjectsRecord->start_time;
                    $wData['end_time'] = $classSubjectsRecord->end_time;
                    $wData['room_number'] = $classSubjectsRecord->room_number;
                } else {
                    $wData['start_time'] = '';
                    $wData['end_time'] = '';
                    $wData['room_number'] = '';
                }
                $weekDays[] = $wData;
            }
            $dataSubject['week_days'] = $weekDays;
            $result[] = $dataSubject;
        }
        $data['records'] = $result;
        return view('teacher.timetable.index', $data);
    }
    public function myTeacherTimetable(Request $request, $classId, $subjectId)
    {
        $data['header_title'] = 'My Timetable';
        $data['className'] = SchoolClass::getSingleClass($classId)->name;
        $data['subjectName'] = Subject::getSingleSubject($subjectId)->name;
        $daysOfWeek = DaysOfWeek::getWeekDays();
        $weekDays = [];
        foreach ($daysOfWeek as $day) {
            $wData = [];
            $wData['week_id'] = $day->id;
            $wData['day_name'] = $day->name;
            $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($classId, $subjectId, $day->id)->first();
            if (isset($classSubjectsRecord)) {
                $wData['start_time'] = $classSubjectsRecord->start_time;
                $wData['end_time'] = $classSubjectsRecord->end_time;
                $wData['room_number'] = $classSubjectsRecord->room_number;
            } else {
                $wData['start_time'] = '';
                $wData['end_time'] = '';
                $wData['room_number'] = '';
            }
            $result[] = $wData;
        }
        $dataSubject['week_days'] = $weekDays;
        $data['records'] = $result;
        return view('teacher.timetable.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassTimetable $classTimetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassTimetable $classTimetable)
    {
        //
    }
}
