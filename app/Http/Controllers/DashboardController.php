<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\NoticeBoard;
use App\Models\SchoolClass;
use App\Models\SubmittedFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function dashboard ()
    {
        $data['header_title'] = 'Dashboard';
        if (!Auth::user() || Auth::user()->status == 0) {
            // $data['record'] = User::getSingleUser(Auth::user()->id)->first();
            return view('student.visitor', $data);
        }
        $userType = Auth::user()->user_type;
        if ($userType == 1) {
            $data['totalCollectedFees'] = SubmittedFee::getTotalCollectedFees();
            $data['totalTodayCollectedFees'] = SubmittedFee::getTotalTodayCollectedFees();
            $data['totalAdminsCount'] = User::getUsersCount(1);
            $data['totalTeachersCount'] = User::getUsersCount(2);
            $data['totalStudentsCount'] = User::getUsersCount(3);
            $data['totalClassesCount'] = SchoolClass::count();
            return view('admin.dashboard', $data);
        } else if ($userType == 2) {
            $data['totalTeachersCount'] = User::getUsersCount(2);
            $data['totalStudentsCount'] = User::getTeacherStudentsCount(Auth::user()->id);
            $data['totalClassesCount'] = ClassTeacher::myClassTeacherSubjectsCount(Auth::user()->id)->count();
            $data['totalNoticesCount'] = NoticeBoard::getTeacherNoticeCount(Auth::user()->id);
            return view('teacher.dashboard', $data);
        } else if ($userType == 3) {
            $data['totalCollectedFees'] = SubmittedFee::getTotalStudentCollectedFees(Auth::user()->id);
            $data['totalSubjects'] = ClassSubject::getSingleStudentClassSubjectsCount(Auth::user()->class_id)->count();
            $data['totalNoticesCount'] = NoticeBoard::getStudentNoticeCount(Auth::user()->id);
            return view('student.dashboard', $data);
        } else if ($userType == 4) {
            return view('parent.dashboard', $data);
        }
    }
}
