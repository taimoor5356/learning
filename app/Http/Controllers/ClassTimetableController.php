<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassSubjectTimetable;
use App\Models\ClassTimetable;
use App\Models\DaysOfWeek;
use App\Models\SchoolClass;
use App\Models\StudentSubject;
use App\Models\Subject;
use Carbon\Carbon;
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
        $data['header_title'] = 'Subject Timetable';
        $data['classes'] = SchoolClass::getClasses()->get();
        if (!(empty($request->class_id))) {
        }
        $data['classSubjects'] = Subject::getSubjects()->get();
        $subjectDaysData = [];
        foreach ($data['classSubjects']  as $key => $subject) {
            $subjectData = [];
            $subjectData['subject_id'] = $subject->id;
            $subjectData['subject_name'] = $subject->name;
            if (!(empty($request->class_id))) {
                $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($request->class_id, $subject->id)->first();
                if (isset($classSubjectsRecord)) {
                    $subjectData['date'] = $classSubjectsRecord->date;
                    $subjectData['start_time'] = $classSubjectsRecord->start_time;
                    $subjectData['end_time'] = $classSubjectsRecord->end_time;
                    $subjectData['room_number'] = $classSubjectsRecord->room_number;
                } else {
                    $subjectData['date'] = '';
                    $subjectData['start_time'] = '';
                    $subjectData['end_time'] = '';
                    $subjectData['room_number'] = '';
                }
            } else {
                $subjectData['date'] = '';
                $subjectData['start_time'] = '';
                $subjectData['end_time'] = '';
                $subjectData['room_number'] = '';
            }
            $subjectDaysData[] = $subjectData;
        }
        $data['subjectDaysData'] = $subjectDaysData;
        $data['records'] = SchoolClass::getClasses()->paginate(25);
        return view('admin.timetable.index', $data);
    }

    public function showSingleSubjectTimetable($batchId, $subjectId)
    {
        $data['header_title'] = 'Subject Timetable';

        $data['record'] = Subject::getSingleSubject($subjectId);
        $data['records'] = ClassSubjectTimetable::getSingleSubjectBatchWiseTimetable($batchId, $subjectId)->get();
        

        return view('admin.timetable.show_single', $data);
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
        foreach ($request->timetable as $key => $timeTable) {
            ClassSubjectTimetable::alreadyAssignedClassTimetable($request['class_id'], $timeTable['subject_id'], $timeTable['date'])->delete();
            if (!empty($timeTable['subject_id']) && !empty($timeTable['date']) && !empty($timeTable['start_time']) && !empty($timeTable['end_time']) && !empty($timeTable['room_number'])) {
                $classTimetable = new ClassSubjectTimetable();
                $classTimetable->date = $timeTable['date'];
                $classTimetable->batch_id = $request['class_id'];
                $classTimetable->class_id = $request['class_id'];
                $classTimetable->subject_id = $timeTable['subject_id'];
                $classTimetable->start_time = $timeTable['start_time'];
                $classTimetable->end_time = $timeTable['end_time'];
                $classTimetable->room_number = $timeTable['room_number'];
                $classTimetable->save(); //remove all save
            }
        }
        return redirect()->back()->with('success', 'Subject Timetable Updated Successfully');
    }

    public function myStudentTimetable(Request $request)
    {
        $data['header_title'] = 'My Timetable';
        
        $result = [];

        $getMySubjects = StudentSubject::getSingleBatchWiseSubjects(Auth::user()->id, Auth::user()->batch_number)->get();
        
        foreach ($getMySubjects as $mySubject) {
            $subjectData = [
                'subject_name' => $mySubject->subject?->name,
                'dates' => []
            ];
            
            $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($mySubject->batch_id, $mySubject->subject_id)->get();
            
            foreach ($classSubjectsRecord as $subjectRecord) {
                $subjectDetail = [
                    'date' => $subjectRecord->date,
                    'start_time' => Carbon::parse($subjectRecord->start_time)->format('h:i a'),
                    'end_time' => Carbon::parse($subjectRecord->end_time)->format('h:i a'),
                    'room_number' => $subjectRecord->room_number,
                ];
                
                $subjectData['dates'][] = $subjectDetail;
            }
            
            $result[] = $subjectData;
        }
        $data['records'] = $result;
        return view('student.timetable.index', $data);
    }

    public function myTeacherTimetableList(Request $request)
    {
        $data['header_title'] = 'My Timetable';
        $result = [];
        $getMySubjects = ClassSubject::getSingleClassSubjects(Auth::user()->batch_number)->get();
        foreach ($getMySubjects as $key => $mySubject) {
            $subjectData = [];
            $subjectData['subject_id'] = $mySubject->subject?->id;
            $subjectData['subject_name'] = $mySubject->subject?->name;
            $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($mySubject->class_id, $mySubject->subject_id)->first();
            if (isset($classSubjectsRecord)) {
                $subjectData['date'] = $classSubjectsRecord->date;
                $subjectData['start_time'] = $classSubjectsRecord->start_time;
                $subjectData['end_time'] = $classSubjectsRecord->end_time;
                $subjectData['room_number'] = $classSubjectsRecord->room_number;
            } else {
                $subjectData['date'] = '';
                $subjectData['start_time'] = '';
                $subjectData['end_time'] = '';
                $subjectData['room_number'] = '';
            }
            $result[] = $subjectData;
        }
        $data['records'] = $result;
        return view('teacher.timetable.index', $data);
    }
    public function myTeacherTimetable(Request $request, $classId, $subjectId)
    {
        $data['header_title'] = 'My Timetable';
        $data['className'] = SchoolClass::getSingleClass($classId)->name;
        $data['subjectName'] = Subject::getSingleSubject($subjectId)->name;
        // $daysOfWeek = DaysOfWeek::getWeekDays();
        // $weekDays = [];
        // foreach ($daysOfWeek as $day) {
            $wData = [];
        //     $wData['week_id'] = $day->id;
        //     $wData['day_name'] = $day->name;
            $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($classId, $subjectId)->first();
            if (isset($classSubjectsRecord)) {
                $wData['date'] = $classSubjectsRecord->date;
                $wData['start_time'] = $classSubjectsRecord->start_time;
                $wData['end_time'] = $classSubjectsRecord->end_time;
                $wData['room_number'] = $classSubjectsRecord->room_number;
            } else {
                $wData['data'] = '';
                $wData['start_time'] = '';
                $wData['end_time'] = '';
                $wData['room_number'] = '';
            }
            $result[] = $wData;
        // }
        // $dataSubject['week_days'] = $weekDays;
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
