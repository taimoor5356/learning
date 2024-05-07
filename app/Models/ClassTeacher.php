<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class ClassTeacher extends Model
{
    use HasFactory, SoftDeletes;

    static public function getClassTeachers() {
        $classTeachers = self::with('user', 'teacher', 'class');
        if (!empty(Request::get('class_name'))) {
            $classTeachers->whereHas('class', function ($query) {
                $query->where('name', 'LIKE', '%' . Request::get('class_name') . '%');
            });
        }
        if (!empty(Request::get('teacher_name'))) {
            $classTeachers->whereHas('teacher', function ($query) {
                $query->where('name', 'LIKE', '%' . Request::get('teacher_name') . '%');
            });
        }
        if (!empty(Request::get('status'))) {
            $status = Request::get('status') == 10 ? 0 : 1;
            $classTeachers = $classTeachers->where('status', $status);
        }
        if (!empty(Request::get('from_date'))) {
            $classTeachers = $classTeachers->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $classTeachers = $classTeachers->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $classTeachers->orderBy('id', 'desc');
    }

    static public function getSingleClassTeacher($id) {
        return self::with('user', 'teacher', 'class')->find($id);
    }

    static public function getTrashedClassTeachers() {
        return self::with('user', 'teacher', 'class')->onlyTrashed()->orderBy('id', 'desc');
    }

    static public function getSingleAlreadyAssigned($classId, $teacherId) {
        return self::where('class_id', $classId)->where('teacher_id', $teacherId)->first();
    }

    static public function getAssignedTeacherId($classId) {
        return self::with('teacher')->where('class_id', $classId);
    }

    static public function myClassTeacherSubjects($teacherId) {
        return ClassTeacher::select('class_teachers.*', 'school_classes.id as new_class_id', 'class_teachers.id as class_teacher_id', 'school_classes.name as class_name', 'subjects.name as subject_name', 'subjects.id as new_subject_id')
        ->join('school_classes', 'school_classes.id', '=', 'class_teachers.class_id')
        ->join('class_subjects', 'class_subjects.class_id', '=', 'school_classes.id')
        ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
        ->where('class_teachers.teacher_id', $teacherId);
    }

    static public function myClassTeacherSubjectsCount($teacherId) {
        return ClassTeacher::with('class')->select('class_teachers.*')
        ->join('school_classes', 'school_classes.id', '=', 'class_teachers.class_id')
        ->where('class_teachers.teacher_id', $teacherId);
    }

    static public function myClassTeacherSubjectsGroup($teacherId) {
        return ClassTeacher::with('class')->select('class_teachers.*', 'school_classes.id as new_class_id', 'class_teachers.id as class_teacher_id', 'school_classes.name as class_name')
        ->join('school_classes', 'school_classes.id', '=', 'class_teachers.class_id')
        ->where('class_teachers.teacher_id', $teacherId)
        ->groupBy('class_teachers.class_id');
    }

    static public function getMyClassSubjects($teacherId) {
        return self::with('user', 'teacher', 'class', 'class_subject.subject')->where('teacher_id', $teacherId);
    }

    static public function getMyClassSubjectTimings($classId, $subjectId) {
        $dayOfWeek = DaysOfWeek::getWeekDayUsingName(date('l'));
        $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($classId, $subjectId, $dayOfWeek->id)->first();
        return $classSubjectsRecord;
        // if (isset($classSubjectsRecord)) {
        //     return Carbon::parse($classSubjectsRecord->start_time)->format('h:i A') . ' to ' . Carbon::parse($classSubjectsRecord->end_time)->format('h:i A');
        // } else {
        //     return 'No class';
        // }
    }

    static public function getTeacherCalendarData($teacherId) {
        return ClassTeacher::select('class_subject_timetables.*', 'school_classes.name as class_name', 'subjects.name as subject_name', 'days_of_weeks.name as week_day_name', 'days_of_weeks.fullcalendar_day')
        ->join('class_subject_timetables', 'class_subject_timetables.class_id', '=', 'class_teachers.class_id')
        ->join('school_classes', 'school_classes.id', '=', 'class_teachers.class_id')
        ->join('subjects', 'subjects.id', '=', 'class_subject_timetables.subject_id')
        ->join('days_of_weeks', 'days_of_weeks.id', '=', 'class_subject_timetables.week_days_id')
        ->where('class_teachers.teacher_id', $teacherId)
        ->get();
    }

    static public function getTeacherExamCalendarData($teacherId) {
        return ClassTeacher::select('exam_schedules.*', 'school_classes.name as class_name', 'subjects.name as subject_name', 'examinations.name as exam_name')
        ->join('exam_schedules', 'class_teachers.class_id', '=', 'exam_schedules.class_id')
        ->join('school_classes', 'school_classes.id', '=', 'exam_schedules.class_id')
        ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
        ->join('examinations', 'examinations.id', '=', 'exam_schedules.exam_id')
        ->where('class_teachers.teacher_id', $teacherId)
        ->get();
    }

    // Relations

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function class() {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function class_subject() {
        return $this->belongsTo(ClassSubject::class, 'class_id', 'class_id');
    }
}
