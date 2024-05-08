<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\FeeCollectionController;
use App\Http\Controllers\HomeWorkController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\ClassTeacher;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => '/'], function () {
    Route::get('', [AuthController::class, 'login'])->name('login');
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'postSignup'])->name('postSignup');
    Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
    Route::post('/post-otp', [AuthController::class, 'postOtp'])->name('postOtp');
    Route::post('login', [AuthController::class, 'authLogin'])->name('authLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
    Route::get('reset/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('reset/{token}', [AuthController::class, 'postResetPassword'])->name('postresetPassword');
    Route::post('/update-password', [UserController::class, 'updatePassword']);
});
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'is_active']], function () {

    // Admin User URLs
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/account', [UserController::class, 'myAccount']);
    Route::post('/update-account', [UserController::class, 'updateMyAdminAccount']);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/list', [AdminController::class, 'index']);
        Route::get('/create', [AdminController::class, 'create']);
        Route::post('/store', [AdminController::class, 'store']);
        Route::get('/show/{id}', [AdminController::class, 'show']);
        Route::get('/edit/{id}', [AdminController::class, 'edit']);
        Route::post('/update/{id}', [AdminController::class, 'update']);
        Route::get('/delete/{id}', [AdminController::class, 'destroy']);
        Route::get('/trashed', [AdminController::class, 'trashed']);
    });

    // Students
    Route::group(['prefix' => 'student'], function () {
        Route::get('/list', [StudentDetailController::class, 'index']);
        Route::get('/create', [StudentDetailController::class, 'create']);
        Route::post('/store', [StudentDetailController::class, 'store']);
        Route::get('/edit/{id}', [StudentDetailController::class, 'edit']);
        Route::get('/edit-single/{id}', [StudentDetailController::class, 'editSingle']);
        Route::post('/update/{id}', [StudentDetailController::class, 'update']);
        Route::post('/update-single/{id}', [StudentDetailController::class, 'updateSingle']);
        Route::get('/delete/{id}', [StudentDetailController::class, 'destroy']);
        Route::get('/trashed', [StudentDetailController::class, 'trashed']);
    });

    // Teachers
    Route::group(['prefix' => 'teacher'], function () {
        Route::get('/list', [TeacherController::class, 'index']);
        Route::get('/create', [TeacherController::class, 'create']);
        Route::post('/store', [TeacherController::class, 'store']);
        Route::get('/edit/{id}', [TeacherController::class, 'edit']);
        Route::get('/edit-single/{id}', [TeacherController::class, 'editSingle']);
        Route::post('/update/{id}', [TeacherController::class, 'update']);
        Route::post('/update-single/{id}', [TeacherController::class, 'updateSingle']);
        Route::get('/delete/{id}', [TeacherController::class, 'destroy']);
        Route::get('/trashed', [TeacherController::class, 'trashed']);
    });

    // Parents
    Route::group(['prefix' => 'parent'], function () {
        Route::get('/list', [ParentController::class, 'index']);
        Route::get('/create', [ParentController::class, 'create']);
        Route::post('/store', [ParentController::class, 'store']);
        Route::get('/edit/{id}', [ParentController::class, 'edit']);
        Route::get('/edit-single/{id}', [ParentController::class, 'editSingle']);
        Route::post('/update/{id}', [ParentController::class, 'update']);
        Route::post('/update-single/{id}', [ParentController::class, 'updateSingle']);
        Route::get('/delete/{id}', [ParentController::class, 'destroy']);
        Route::get('/trashed', [ParentController::class, 'trashed']);
    });

    // Update password
    Route::group(['prefix' => 'password'], function () {
        Route::get('/edit', [UserController::class, 'editPassword']);
    });

    // Class URLs
    Route::group(['prefix' => 'class'], function () {
        Route::get('/list', [SchoolClassController::class, 'index']);
        Route::get('/create', [SchoolClassController::class, 'create']);
        Route::post('/store', [SchoolClassController::class, 'store']);
        Route::get('/edit/{id}', [SchoolClassController::class, 'edit']);
        Route::post('/update/{id}', [SchoolClassController::class, 'update']);
        Route::get('/delete/{id}', [SchoolClassController::class, 'destroy']);
        Route::get('/trashed', [SchoolClassController::class, 'trashed']);
    });

    // Subject URLs
    Route::group(['prefix' => 'subject'], function () {
        Route::get('/list', [SubjectController::class, 'index']);
        Route::get('/create', [SubjectController::class, 'create']);
        Route::post('/store', [SubjectController::class, 'store']);
        Route::get('/edit/{id}', [SubjectController::class, 'edit']);
        Route::post('/update/{id}', [SubjectController::class, 'update']);
        Route::get('/delete/{id}', [SubjectController::class, 'destroy']);
        Route::get('/trashed', [SubjectController::class, 'trashed']);
    });

    // Assign Class Subject URLs
    Route::group(['prefix' => 'class-subject'], function () {
        Route::get('/list', [ClassSubjectController::class, 'index']);
        Route::get('/create', [ClassSubjectController::class, 'create']);
        Route::post('/store', [ClassSubjectController::class, 'store']);
        Route::get('/edit/{id}', [ClassSubjectController::class, 'edit']);
        Route::get('/edit-single/{id}', [ClassSubjectController::class, 'editSingle']);
        Route::post('/update/{id}', [ClassSubjectController::class, 'update']);
        Route::post('/update-single/{id}', [ClassSubjectController::class, 'updateSingle']);
        Route::get('/delete/{id}', [ClassSubjectController::class, 'destroy']);
        Route::get('/trashed', [ClassSubjectController::class, 'trashed']);
    });

    // Timetable
    Route::group(['prefix' => 'class-timetable'], function () {
        Route::get('/list', [ClassTimetableController::class, 'index']);
        Route::get('/create', [ClassTimetableController::class, 'create']);
        Route::post('/store', [ClassTimetableController::class, 'store']);
        Route::get('/edit/{id}', [ClassTimetableController::class, 'edit']);
        Route::get('/edit-single/{id}', [ClassTimetableController::class, 'editSingle']);
        Route::post('/update/{id}', [ClassTimetableController::class, 'update']);
        Route::post('/update-single/{id}', [ClassTimetableController::class, 'updateSingle']);
        Route::get('/delete/{id}', [ClassTimetableController::class, 'destroy']);
        Route::get('/trashed', [ClassTimetableController::class, 'trashed']);

        Route::post('/subjects', [ClassTimetableController::class, 'getClassSubjects']);
        Route::post('/add', [ClassTimetableController::class, 'insertOrUpdate']);
    });

    // Assign Class Teacher URLs
    Route::group(['prefix' => 'class-teacher'], function () {
        Route::get('/list', [ClassTeacherController::class, 'index']);
        Route::get('/create', [ClassTeacherController::class, 'create']);
        Route::post('/store', [ClassTeacherController::class, 'store']);
        Route::get('/edit/{id}', [ClassTeacherController::class, 'edit']);
        Route::get('/edit-single/{id}', [ClassTeacherController::class, 'editSingle']);
        Route::post('/update/{id}', [ClassTeacherController::class, 'update']);
        Route::post('/update-single/{id}', [ClassTeacherController::class, 'updateSingle']);
        Route::get('/delete/{id}', [ClassTeacherController::class, 'destroy']);
        Route::get('/trashed', [ClassTeacherController::class, 'trashed']);
    });

    // Examinations
    Route::group(['prefix' => 'examinations'], function () {
        Route::get('/exams-list', [ExaminationController::class, 'index']);
        Route::get('/create-exams', [ExaminationController::class, 'create']);
        Route::post('/store-exams', [ExaminationController::class, 'store']);
        Route::get('/exams-edit/{id}', [ExaminationController::class, 'edit']);
        Route::post('/exams-update/{id}', [ExaminationController::class, 'update']);
        Route::get('/delete-exam/{id}', [ExaminationController::class, 'destroy']);
        Route::get('/trashed-exams', [ExaminationController::class, 'trashed']);
        Route::get('/scheduled-exams', [ExaminationController::class, 'examSchedule']);
        Route::post('/store-scheduled-exams', [ExaminationController::class, 'storeExamSchedule']);
        Route::get('/create-scheduled-exams', [ExaminationController::class, 'createScheduleExam']);

        // Marks Registeratino
        Route::get('/subject-marks', [ExaminationController::class, 'SubjectMarks']);
        Route::post('/subject-marks', [ExaminationController::class, 'storeSubjectMarks']);
        Route::post('/store-single-subject-marks', [ExaminationController::class, 'storeSingleSubjectMarks']);
    });

    // Attendance
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/student-attendance', [AttendanceController::class, 'studentAttendance']);
        Route::post('/store-student-attendance', [AttendanceController::class, 'storeStudentAttendance']);
        Route::get('/student-attendance-report', [AttendanceController::class, 'studentAttendanceReport']);
    });

    // Communicate
    Route::group(['prefix' => 'communicate'], function () {
        Route::group(['prefix' => 'notice-board'], function () {
            Route::get('/list', [CommunicateController::class, 'index']);
            Route::get('/create', [CommunicateController::class, 'create']);
            Route::post('/store', [CommunicateController::class, 'store']);
            Route::get('/edit/{id}', [CommunicateController::class, 'edit']);
            Route::post('/update/{id}', [CommunicateController::class, 'update']);
            Route::get('/delete/{id}', [CommunicateController::class, 'destroy']);
            Route::get('/trashed', [CommunicateController::class, 'trashed']);
        });
        Route::group(['prefix' => 'emails'], function () {
            Route::get('/search-user', [CommunicateController::class, 'searchUser']);
            Route::get('/send', [CommunicateController::class, 'sendEmail']);
            Route::post('/send', [CommunicateController::class, 'sendToUser']);
        });
    });

    // Fee Collection
    Route::group(['prefix' => 'fee-collection'], function () {
        Route::get('/list', [FeeCollectionController::class, 'index']);
        Route::get('/report', [FeeCollectionController::class, 'feeCollectionReport']);
        Route::get('/collect-fee/{id}', [FeeCollectionController::class, 'create']);
        Route::post('/collect-fee/{id}', [FeeCollectionController::class, 'store']);
    });

    // Homework
    Route::group(['prefix' => 'home-work'], function () {
        Route::get('/list', [HomeWorkController::class, 'index']);
        Route::get('/create', [HomeWorkController::class, 'create']);
        Route::post('/store', [HomeWorkController::class, 'store']);
        Route::get('/edit/{id}', [HomeWorkController::class, 'edit']);
        Route::post('/update/{id}', [HomeWorkController::class, 'update']);
        Route::get('/delete/{id}', [HomeWorkController::class, 'destroy']);
        Route::get('/trashed', [HomeWorkController::class, 'trashed']);
        Route::get('/submitted-list', [HomeWorkController::class, 'submittedHomeWorkList']);
        Route::get('/submitted/{id}', [HomeWorkController::class, 'submittedHomeWork']);
        Route::get('/get-class-subjects', [HomeWorkController::class, 'getClassSubjects']);
    });

    // Homework
    Route::group(['prefix' => 'settings'], function () {
        Route::get('', [SettingController::class, 'index']);
        Route::post('/update/{id}', [SettingController::class, 'update']);
    });
});
Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/account', [UserController::class, 'myAccount']);
    Route::post('/update-account', [UserController::class, 'updateMyTeacherAccount']);

    // My Subject
    Route::group(['prefix' => 'subject'], function () {
        Route::get('/list', [ClassTeacherController::class, 'myTeacherClassSubjects']);
        Route::get('/class-timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'myTeacherTimetable']);
    });

    // My Student
    Route::group(['prefix' => 'student'], function () {
        Route::get('/list', [StudentDetailController::class, 'myTeacherStudents']);
    });

    // My Timetable
    Route::group(['prefix' => 'class-timetable'], function () {
        Route::get('/list', [ClassTimetableController::class, 'myTeacherTimetableList']);
    });

    // Update password
    Route::group(['prefix' => 'password'], function () {
        Route::get('/edit', [UserController::class, 'editPassword']);
    });

    // Examinations
    Route::group(['prefix' => 'examinations'], function () {
        Route::get('/scheduled-exams', [ExaminationController::class, 'teacherExamSchedule']);

        // Marks Registeratino
        Route::get('/subject-marks', [ExaminationController::class, 'teacherSubjectMarks']);
        Route::post('/subject-marks', [ExaminationController::class, 'teacherStoreSubjectMarks']);
        Route::post('/store-single-subject-marks', [ExaminationController::class, 'teacherStoreSingleSubjectMarks']);
    });

    // Calendar
    Route::group(['prefix' => 'calendar'], function () {
        Route::get('/show', [CalendarController::class, 'teacherCalendar']);
    });

    // Attendance
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/student-attendance', [AttendanceController::class, 'teacherStudentAttendance']);
        Route::post('/store-student-attendance', [AttendanceController::class, 'storeteacherStudentAttendance']);
        Route::get('/student-attendance-report', [AttendanceController::class, 'teacherStudentAttendanceReport']);
    });

    // Communicate
    Route::group(['prefix' => 'communicate'], function () {
        Route::group(['prefix' => 'notice-board'], function () {
            Route::get('/list', [CommunicateController::class, 'teacherNoticeBoard']);
        });
    });

    // Homework
    Route::group(['prefix' => 'home-work'], function () {
        Route::get('/list', [HomeWorkController::class, 'teacherHomeWork']);
        Route::get('/create', [HomeWorkController::class, 'createTeacherHomeWork']);
        Route::post('/store', [HomeWorkController::class, 'storeTeacherHomeWork']);
        Route::get('/edit/{id}', [HomeWorkController::class, 'editTeacherHomeWork']);
        Route::post('/update/{id}', [HomeWorkController::class, 'updateTeacherHomeWork']);
        Route::get('/delete/{id}', [HomeWorkController::class, 'destroyTeacherHomeWork']);
        // Route::get('/trashed', [HomeWorkController::class, 'trashed']);
        Route::get('/get-class-subjects', [HomeWorkController::class, 'getClassSubjects']);
    });
});
Route::group(['prefix' => 'student', 'middleware' => 'student'], function () {
    Route::group(['middleware' => ['otp_verified']], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);
        Route::post('/visitor/store', [StudentDetailController::class, 'storeVisitor']);
    });
    Route::group(['middleware' => 'student_is_active'], function () {
        // My Subject
        Route::get('/account', [UserController::class, 'myAccount']);
        Route::post('/update-account', [UserController::class, 'updateMyStudentAccount']);
        Route::group(['prefix' => 'subject'], function () {
            Route::get('/list', [SubjectController::class, 'myStudentSubjects']);
        });

        // My Timetable
        Route::group(['prefix' => 'class-timetable'], function () {
            Route::get('/list', [ClassTimetableController::class, 'myStudentTimetable']);
        });

        // Fee Collection
        Route::group(['prefix' => 'fee-collection'], function () {
            Route::get('/list', [FeeCollectionController::class, 'studentFeesCollection']);
        });

        // Update password
        Route::group(['prefix' => 'password'], function () {
            Route::get('/edit', [UserController::class, 'editPassword']);
        });

        // Examinations
        Route::group(['prefix' => 'examinations'], function () {
            Route::get('/scheduled-exams', [ExaminationController::class, 'studentExamSchedule']);

            // Marks Registeration
            Route::get('/print', [ExaminationController::class, 'studentPrintExamResult']);
            Route::get('/subject-marks', [ExaminationController::class, 'studentSubjectMarks']);
            Route::post('/subject-marks', [ExaminationController::class, 'studentStoreSubjectMarks']);
            Route::post('/store-single-subject-marks', [ExaminationController::class, 'studentStoreSingleSubjectMarks']);
        });

        // Calendar
        Route::group(['prefix' => 'calendar'], function () {
            Route::get('/show', [CalendarController::class, 'studentCalendar']);
        });

        // Attendance
        Route::group(['prefix' => 'attendance'], function () {
            Route::get('/student-attendance', [AttendanceController::class, 'myAttendanceReport']);
            // Route::get('/student-attendance-report', [AttendanceController::class, 'myAttendanceReport']);
        });

        // Communicate
        Route::group(['prefix' => 'communicate'], function () {
            Route::group(['prefix' => 'notice-board'], function () {
                Route::get('/list', [CommunicateController::class, 'studentNoticeBoard']);
            });
        });

        // Homework
        Route::group(['prefix' => 'home-work'], function () {
            Route::get('/list', [HomeWorkController::class, 'studentHomeWork']);
            Route::get('/submit-homework/{id}', [HomeWorkController::class, 'createStudentHomeWork']);
            Route::post('/store/{id}', [HomeWorkController::class, 'storeStudentHomeWork']);
            Route::get('/submitted', [HomeWorkController::class, 'submittedStudentHomeWork']);
            // Route::post('/update/{id}', [HomeWorkController::class, 'updateStudentHomeWork']);
            // Route::get('/delete/{id}', [HomeWorkController::class, 'destroyStudentHomeWork']);
            // Route::get('/trashed', [HomeWorkController::class, 'trashed']);
            Route::get('/get-class-subjects', [HomeWorkController::class, 'getClassSubjects']);
        });
    });
});
Route::group(['prefix' => 'parent', 'middleware' => 'parent'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    // Update password
    Route::group(['prefix' => 'password'], function () {
        Route::get('/edit', [UserController::class, 'editPassword']);
    });
});
