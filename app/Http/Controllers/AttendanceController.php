<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassTeacher;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function myAttendanceReport(Request $request) 
    {
        $data['classes'] = Attendance::getStudentClasses(Auth::user()->id)->get();
        $data['records'] = Attendance::getStudentAttendanceRecord(Auth::user()->id)->paginate(25);
        $data['header_title'] = 'Student Attendance Report';
        return view('student.attendance.student_attendance_report', $data);
    }
    /**
     * Display a listing of the resource.
     */
    public function studentAttendance(Request $request)
    {
        //
        $data['classes'] = SchoolClass::getClasses()->get();
        if (!empty($request->get('class_id')) && $request->get('attendance_date')) {
            $data['students'] = User::getStudentClass($request->get('class_id'))->paginate(25);
        } else {
            $data['students'] = User::getStudentClass(0)->paginate(25);
        }
        $data['header_title'] = 'Student Attendance';
        return view('admin.attendance.student', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function storeStudentAttendance(Request $request)
    {
        //
        try {
            $checkAlreadyMarkedAttendance = Attendance::checkAlreadyMarkedAttendance($request->student_id, $request->class_id, $request->attendance_date)->first();
            if (isset($checkAlreadyMarkedAttendance)) {
                $attendance = $checkAlreadyMarkedAttendance;
            } else {
                $attendance = new Attendance();
                $attendance->class_id = $request->class_id;
                $attendance->attendance_date = $request->attendance_date;
                $attendance->user_id = $request->student_id;
            }
            $attendance->attendance_status = $request->attendance_status;
            $attendance->created_by = Auth::user()->id;
            $attendance->save();
            return response()->json([
                'status' => true,
                'msg' => 'Attendance marked successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function studentAttendanceReport(Request $request) 
    {
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['records'] = Attendance::getAttendances()->paginate(25);
        $data['header_title'] = 'Student Attendance Report';
        return view('admin.attendance.student_attendance_report', $data);
    }

    
    public function teacherStudentAttendance(Request $request)
    {
        //
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        if (!empty($request->get('class_id')) && $request->get('attendance_date')) {
            $data['students'] = User::getStudentClass($request->get('class_id'))->paginate(25);
        } else {
            $data['students'] = User::getStudentClass(0)->paginate(25);
        }
        $data['header_title'] = 'Student Attendance';
        return view('teacher.attendance.student', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function storeteacherStudentAttendance(Request $request)
    {
        //
        try {
            $checkAlreadyMarkedAttendance = Attendance::checkAlreadyMarkedAttendance($request->student_id, $request->class_id, $request->attendance_date)->first();
            if (isset($checkAlreadyMarkedAttendance)) {
                $attendance = $checkAlreadyMarkedAttendance;
            } else {
                $attendance = new Attendance();
                $attendance->class_id = $request->class_id;
                $attendance->attendance_date = $request->attendance_date;
                $attendance->user_id = $request->student_id;
            }
            $attendance->attendance_status = $request->attendance_status;
            $attendance->created_by = Auth::user()->id;
            $attendance->save();
            return response()->json([
                'status' => true,
                'msg' => 'Attendance marked successfully'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function teacherStudentAttendanceReport(Request $request) 
    {
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $classArray = [];
        foreach ($data['classes'] as $class) {
            $classArray[] = $class->class_id;
        }
        $data['records'] = Attendance::getTeacherAttendanceRecord($classArray)->paginate(25);
        $data['header_title'] = 'Student Attendance Report';
        return view('teacher.attendance.student_attendance_report', $data);
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
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
