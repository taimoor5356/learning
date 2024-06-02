<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static public function checkAlreadyMarkedAttendance($userId, $classId, $attendanceDate) {
        return Attendance::where('user_id', $userId)
            ->where('class_id', $classId)
            ->whereDate('attendance_date', $attendanceDate);
    }

    static public function getAttendances() {
        $attendances = self::with('user', 'class', 'studentTeacherUser');
        if (!empty(Request::get('student_name'))) {
            $attendances->whereHas('studentTeacherUser', function ($q) {
                $q->where('name', 'LIKE', '%' . Request::get('student_name') . '%');
            });
        }
        if (!empty(Request::get('roll_number'))) {
            $attendances->whereHas('studentTeacherUser', function ($q) {
                $q->where('roll_number',  Request::get('roll_number'));
            });
        }
        if (!empty(Request::get('class_id'))) {
            $attendances->where('class_id', Request::get('class_id'));
        }
        if (!empty(Request::get('attendance_date'))) {
            $attendances->whereDate('attendance_date', Request::get('attendance_date'));
        }
        if (!empty(Request::get('attendance_status'))) {
            $attendances->where('attendance_status', Request::get('attendance_status'));
        }
        return $attendances;
    }

    static public function getStudentClasses($studentId) {
        $attendances = self::with('user', 'class', 'studentTeacherUser')->where('user_id', $studentId);
        return $attendances->groupBy('class_id');
    }

    static public function getStudentAttendanceRecord($studentId) {
        if (!empty($studentId)) {
            $attendances = self::with('user', 'class', 'studentTeacherUser')->where('user_id', $studentId);
            if (!empty(Request::get('class_id'))) {
                $attendances->where('class_id', Request::get('class_id'));
            }
            if (!empty(Request::get('attendance_date'))) {
                $attendances->whereDate('attendance_date', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_status'))) {
                $attendances->where('attendance_status', Request::get('attendance_status'));
            }
            return $attendances;
        }
    }

    static public function getTeacherAttendanceRecord($classIds) {
        if (!empty($classIds)) {
            $attendances = self::with('user', 'class', 'studentTeacherUser')->whereIn('class_id', $classIds);
            if (!empty(Request::get('student_name'))) {
                $attendances->whereHas('studentTeacherUser', function ($q) {
                    $q->where('name', 'LIKE', '%' . Request::get('student_name') . '%');
                });
            }
            if (!empty(Request::get('roll_number'))) {
                $attendances->whereHas('studentTeacherUser', function ($q) {
                    $q->where('roll_number',  Request::get('roll_number'));
                });
            }
            if (!empty(Request::get('class_id'))) {
                $attendances->where('class_id', Request::get('class_id'));
            }
            if (!empty(Request::get('attendance_date'))) {
                $attendances->whereDate('attendance_date', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_status'))) {
                $attendances->where('attendance_status', Request::get('attendance_status'));
            }
            return $attendances;
        }
    }

    public function studentTeacherUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function student() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function class() {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }
}
