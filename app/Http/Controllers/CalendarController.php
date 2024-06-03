<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimetable;
use App\Models\ClassTeacher;
use App\Models\DaysOfWeek;
use App\Models\Examination;
use App\Models\ExamSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentCalendar()
    {
        //
        $data['header_title'] = 'My Calendar';
        $data['myTimeTable'] = $this->myStudentTimeTable(Auth::user()->batch_number);
        $data['myExamTimeTable'] = $this->myStudentExamTimeTable(Auth::user()->batch_number);
        // $data['records'] = Examination::getExams();
        return view('student.calendar.index', $data);
    }

    public function myStudentExamTimeTable($batchId)
    {
        $getExamSchedule = ExamSchedule::getSingleClassSchedule($batchId)->get();
        $result = [];
        foreach ($getExamSchedule as $examSchedule) {
            $examData = [];
            $examData['exam_name'] = $examSchedule->exam?->name;
            $classExamSchedule = ExamSchedule::getSingleExamClassSchedule($examSchedule->exam?->id, $batchId)->get();
            $subjectResult = [];
            foreach ($classExamSchedule as $key => $classExamScheduleSubject) {
                $subjectData = [];
                $subjectData['subject_id'] = $classExamScheduleSubject->subject_id;
                $subjectData['batch_id'] = $classExamScheduleSubject->batch_id;
                $subjectData['class_id'] = $classExamScheduleSubject->class_id;
                $subjectData['subject_name'] = $classExamScheduleSubject->subject?->name;
                $subjectData['subject_type'] = $classExamScheduleSubject->subject?->type;
                $subjectData['exam_date'] = $classExamScheduleSubject->exam_date;
                $subjectData['start_time'] = Carbon::parse($classExamScheduleSubject->start_time)->format('h:i a');
                $subjectData['end_time'] = Carbon::parse($classExamScheduleSubject->end_time)->format('h:i a');
                $subjectData['room_number'] = $classExamScheduleSubject->room_number;
                $subjectData['full_marks'] = $classExamScheduleSubject->full_marks;
                $subjectData['passing_marks'] = $classExamScheduleSubject->passing_marks;
                $subjectResult[] = $subjectData;
            }
            $examData['exam'] = $subjectResult;
            $result[] = $examData;
        }
        return $result;
    }

    public function myStudentTimeTable($batchId) 
    {
        $result = [];
        $getMySubjects = ClassSubject::getSingleClassSubjects($batchId)->get();
        foreach ($getMySubjects as $key => $mySubject) {
            $dataSubject['subject_name'] = $mySubject->subject->name;
            $daysOfWeek = DaysOfWeek::getWeekDays();
            $weekDays = [];
            foreach ($daysOfWeek as $day) {
                $wData = [];
                $wData['week_id'] = $day->id;
                $wData['day_name'] = $day->name;
                $wData['fullcalendar_day'] = $day->fullcalendar_day;
                $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($mySubject->class_id, $mySubject->subject_id, $day->id)->first();
                if (isset($classSubjectsRecord)) {
                    $wData['start_time'] = $classSubjectsRecord->start_time;
                    $wData['end_time'] = $classSubjectsRecord->end_time;
                    $wData['room_number'] = $classSubjectsRecord->room_number;
                    $weekDays[] = $wData;
                }
            }
            $dataSubject['week_days'] = $weekDays;
            $result[] = $dataSubject;
        }
        return $result;
    }

    public function teacherCalendar()
    {
        //
        $data['header_title'] = 'My Calendar';
        $data['teacherClassTimeTable'] = ClassTeacher::getTeacherCalendarData(Auth::user()->id);
        $data['teacherExamClassTimeTable'] = ClassTeacher::getTeacherExamCalendarData(Auth::user()->id);
        return view('teacher.calendar.index', $data);
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
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
