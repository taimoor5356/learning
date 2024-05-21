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
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseHeadController;
use App\Http\Controllers\FeeCollectionController;
use App\Http\Controllers\HomeWorkController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoomClassController;
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
    Route::get('/carousel', function () {
        return view('carousel');
    });
    Route::get('', [AuthController::class, 'login'])->name('login');
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'postSignup'])->name('postSignup');
    Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
    Route::post('/post-otp', [AuthController::class, 'postOtp'])->name('postOtp');
    Route::get('/resend-otp', [AuthController::class, 'resendOTP'])->name('postOtp');
    Route::post('login', [AuthController::class, 'authLogin'])->name('authLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
    Route::get('reset/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('reset/{token}', [AuthController::class, 'postResetPassword'])->name('postresetPassword');
    Route::post('/update-password', [UserController::class, 'updatePassword']);
    Route::get('/follow-us', function () {
        $data['header_title'] = 'Follow Us';
        return view('follow_us', $data);
    });
    Route::get('/student-services', function () {
        $data['header_title'] = 'Student Services';
        return view('student_services', $data);
    });
    Route::group(['prefix' => 'zoom-classes', 'middleware' => ['auth']], function () {
        Route::get('/', [ZoomClassController::class, 'index']);
        Route::group(['prefix' => '/', 'middleware' => ['admin']], function () {
            Route::get('create', [ZoomClassController::class, 'create']);
            Route::post('store', [ZoomClassController::class, 'store']);
            Route::get('edit/{id}', [ZoomClassController::class, 'edit']);
            Route::post('update/{id}', [ZoomClassController::class, 'update']);
        });
    });
});
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'is_active']], function () {

    // Admin User URLs
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/account', [UserController::class, 'myAccount']);
    Route::post('/update-account', [UserController::class, 'updateMyAdminAccount']);

    Route::group(['prefix' => 'acl', 'middleware' => ['permission:role_permission_view']], function () {
        Route::get('/roles', [RolePermissionController::class, 'roles'])->middleware('permission:role_permission_view');
        Route::get('/role/create', [RolePermissionController::class, 'createRole'])->middleware('permission:role_permission_create');
        Route::post('/role/store', [RolePermissionController::class, 'storeRole'])->middleware('permission:role_permission_create');
        Route::get('/role/edit/{id}', [RolePermissionController::class, 'editRole'])->middleware('permission:role_permission_update');
        Route::post('/role/update/{id}', [RolePermissionController::class, 'updateRole'])->middleware('permission:role_permission_update');

        Route::get('/permissions', [RolePermissionController::class, 'permissions'])->middleware('permission:role_permission_view');
        Route::get('/permission/create', [RolePermissionController::class, 'createPermission'])->middleware('permission:role_permission_create');
        Route::post('/permission/store', [RolePermissionController::class, 'storePermission'])->middleware('permission:role_permission_create');

        // Route::get('/roles', [RolePermissionController::class, 'roles']);
        // Route::get('/role/create', [RolePermissionController::class, 'createRole']);
        // Route::post('/role/store', [RolePermissionController::class, 'storeRole']);
        // Route::get('/role/edit/{id}', [RolePermissionController::class, 'editRole']);
        // Route::post('/role/update/{id}', [RolePermissionController::class, 'updateRole']);

        // Route::get('/permissions', [RolePermissionController::class, 'permissions']);
        // Route::get('/permission/create', [RolePermissionController::class, 'createPermission']);
        // Route::post('/permission/store', [RolePermissionController::class, 'storePermission']);
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['permission:user_view']], function () {
        Route::get('/list', [AdminController::class, 'index'])->middleware('permission:user_view');
        Route::get('/create', [AdminController::class, 'create'])->middleware('permission:user_create');
        Route::post('/store', [AdminController::class, 'store'])->middleware('permission:user_create');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->middleware('permission:user_update');
        Route::get('/edit-single/{id}', [AdminController::class, 'editSingle'])->middleware('permission:user_update');
        Route::post('/update/{id}', [AdminController::class, 'update'])->middleware('permission:user_update');
        Route::post('/update-single/{id}', [AdminController::class, 'updateSingle'])->middleware('permission:user_update');
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->middleware('permission:user_delete');
        Route::get('/trashed', [AdminController::class, 'trashed'])->middleware('permission:user_view');

        // Route::get('/list', [AdminController::class, 'index']);
        // Route::get('/create', [AdminController::class, 'create']);
        // Route::post('/store', [AdminController::class, 'store']);
        // Route::get('/show/{id}', [AdminController::class, 'show']);
        // Route::get('/edit/{id}', [AdminController::class, 'edit']);
        // Route::post('/update/{id}', [AdminController::class, 'update']);
        // Route::get('/delete/{id}', [AdminController::class, 'destroy']);
        // Route::get('/trashed', [AdminController::class, 'trashed']);
    });

    // Students
    Route::group(['prefix' => 'student', 'middleware' => ['permission:user_view']], function () {
        Route::get('/list', [StudentDetailController::class, 'index'])->middleware('permission:user_view');
        Route::get('/create', [StudentDetailController::class, 'create'])->middleware('permission:user_create');
        Route::post('/store', [StudentDetailController::class, 'store'])->middleware('permission:user_create');
        Route::get('/edit/{id}', [StudentDetailController::class, 'edit'])->middleware('permission:user_update');
        Route::get('/edit-single/{id}', [StudentDetailController::class, 'editSingle'])->middleware('permission:user_update');
        Route::post('/update/{id}', [StudentDetailController::class, 'update'])->middleware('permission:user_update');
        Route::post('/update-single/{id}', [StudentDetailController::class, 'updateSingle'])->middleware('permission:user_update');
        Route::get('/delete/{id}', [StudentDetailController::class, 'destroy'])->middleware('permission:user_delete');
        Route::get('/trashed', [StudentDetailController::class, 'trashed'])->middleware('permission:user_delete');

        // Route::get('/list', [StudentDetailController::class, 'index']);
        // Route::get('/create', [StudentDetailController::class, 'create']);
        // Route::post('/store', [StudentDetailController::class, 'store']);
        // Route::get('/edit/{id}', [StudentDetailController::class, 'edit']);
        // Route::get('/edit-single/{id}', [StudentDetailController::class, 'editSingle']);
        // Route::post('/update/{id}', [StudentDetailController::class, 'update']);
        // Route::post('/update-single/{id}', [StudentDetailController::class, 'updateSingle']);
        // Route::get('/delete/{id}', [StudentDetailController::class, 'destroy']);
        // Route::get('/trashed', [StudentDetailController::class, 'trashed']);
    });

    // Teachers
    Route::group(['prefix' => 'teacher', 'middleware' => ['permission:user_view']], function () {
        Route::get('/list', [TeacherController::class, 'index'])->middleware('permission:user_view');
        Route::get('/create', [TeacherController::class, 'create'])->middleware('permission:user_create');
        Route::post('/store', [TeacherController::class, 'store'])->middleware('permission:user_create');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->middleware('permission:user_update');
        Route::get('/edit-single/{id}', [TeacherController::class, 'editSingle'])->middleware('permission:user_update');
        Route::post('/update/{id}', [TeacherController::class, 'update'])->middleware('permission:user_update');
        Route::post('/update-single/{id}', [TeacherController::class, 'updateSingle'])->middleware('permission:user_update');
        Route::get('/delete/{id}', [TeacherController::class, 'destroy'])->middleware('permission:user_delete');
        Route::get('/trashed', [TeacherController::class, 'trashed'])->middleware('permission:user_delete');

        // Route::get('/list', [TeacherController::class, 'index']);
        // Route::get('/create', [TeacherController::class, 'create']);
        // Route::post('/store', [TeacherController::class, 'store']);
        // Route::get('/edit/{id}', [TeacherController::class, 'edit']);
        // Route::get('/edit-single/{id}', [TeacherController::class, 'editSingle']);
        // Route::post('/update/{id}', [TeacherController::class, 'update']);
        // Route::post('/update-single/{id}', [TeacherController::class, 'updateSingle']);
        // Route::get('/delete/{id}', [TeacherController::class, 'destroy']);
        // Route::get('/trashed', [TeacherController::class, 'trashed']);
    });

    // Parents
    Route::group(['prefix' => 'parent', 'middleware' => ['permission:user_view']], function () {
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
    Route::group(['prefix' => 'class', 'middleware' => ['permission:school_class_view']], function () {
        Route::get('/list', [SchoolClassController::class, 'index'])->middleware('permission:school_class_view');
        Route::get('/create', [SchoolClassController::class, 'create'])->middleware('permission:school_class_create');
        Route::post('/store', [SchoolClassController::class, 'store'])->middleware('permission:school_class_create');
        Route::get('/edit/{id}', [SchoolClassController::class, 'edit'])->middleware('permission:school_class_update');
        Route::post('/update/{id}', [SchoolClassController::class, 'update'])->middleware('permission:school_class_update');
        Route::get('/delete/{id}', [SchoolClassController::class, 'destroy'])->middleware('permission:school_class_delete');
        Route::get('/trashed', [SchoolClassController::class, 'trashed'])->middleware('permission:school_class_delete');

        // Route::get('/list', [SchoolClassController::class, 'index']);
        // Route::get('/create', [SchoolClassController::class, 'create']);
        // Route::post('/store', [SchoolClassController::class, 'store']);
        // Route::get('/edit/{id}', [SchoolClassController::class, 'edit']);
        // Route::post('/update/{id}', [SchoolClassController::class, 'update']);
        // Route::get('/delete/{id}', [SchoolClassController::class, 'destroy']);
        // Route::get('/trashed', [SchoolClassController::class, 'trashed']);
    });

    // Subject URLs
    Route::group(['prefix' => 'subject', 'middleware' => ['permission:school_class_view']], function () {
        Route::get('/list', [SubjectController::class, 'index'])->middleware('permission:school_class_view');
        Route::get('/create', [SubjectController::class, 'create'])->middleware('permission:school_class_create');
        Route::post('/store', [SubjectController::class, 'store'])->middleware('permission:school_class_create');
        Route::get('/edit/{id}', [SubjectController::class, 'edit'])->middleware('permission:school_class_update');
        Route::post('/update/{id}', [SubjectController::class, 'update'])->middleware('permission:school_class_update');
        Route::get('/delete/{id}', [SubjectController::class, 'destroy'])->middleware('permission:school_class_delete');
        Route::get('/trashed', [SubjectController::class, 'trashed'])->middleware('permission:school_class_delete');

        // Route::get('/list', [SubjectController::class, 'index']);
        // Route::get('/create', [SubjectController::class, 'create']);
        // Route::post('/store', [SubjectController::class, 'store']);
        // Route::get('/edit/{id}', [SubjectController::class, 'edit']);
        // Route::post('/update/{id}', [SubjectController::class, 'update']);
        // Route::get('/delete/{id}', [SubjectController::class, 'destroy']);
        // Route::get('/trashed', [SubjectController::class, 'trashed']);
    });

    // Assign Class Subject URLs
    Route::group(['prefix' => 'class-subject', 'middleware' => ['permission:school_class_view']], function () {
        Route::get('/list', [ClassSubjectController::class, 'index'])->middleware('permission:school_class_view');
        Route::get('/create', [ClassSubjectController::class, 'create'])->middleware('permission:school_class_create');
        Route::post('/store', [ClassSubjectController::class, 'store'])->middleware('permission:school_class_create');
        Route::get('/edit/{id}', [ClassSubjectController::class, 'edit'])->middleware('permission:school_class_update');
        Route::get('/edit-single/{id}', [ClassSubjectController::class, 'editSingle'])->middleware('permission:school_class_update');
        Route::post('/update/{id}', [ClassSubjectController::class, 'update'])->middleware('permission:school_class_update');
        Route::post('/update-single/{id}', [ClassSubjectController::class, 'updateSingle'])->middleware('permission:school_class_update');
        Route::get('/delete/{id}', [ClassSubjectController::class, 'destroy'])->middleware('permission:school_class_delete');
        Route::get('/trashed', [ClassSubjectController::class, 'trashed'])->middleware('permission:school_class_delete');

        // Route::get('/list', [ClassSubjectController::class, 'index']);
        // Route::get('/create', [ClassSubjectController::class, 'create']);
        // Route::post('/store', [ClassSubjectController::class, 'store']);
        // Route::get('/edit/{id}', [ClassSubjectController::class, 'edit']);
        // Route::get('/edit-single/{id}', [ClassSubjectController::class, 'editSingle']);
        // Route::post('/update/{id}', [ClassSubjectController::class, 'update']);
        // Route::post('/update-single/{id}', [ClassSubjectController::class, 'updateSingle']);
        // Route::get('/delete/{id}', [ClassSubjectController::class, 'destroy']);
        // Route::get('/trashed', [ClassSubjectController::class, 'trashed']);
    });

    // Timetable
    Route::group(['prefix' => 'class-timetable', 'middleware' => ['permission:school_class_view']], function () {
        Route::get('/list', [ClassTimetableController::class, 'index'])->middleware('permission:school_class_view');
        Route::get('/create', [ClassTimetableController::class, 'create'])->middleware('permission:school_class_create');
        Route::post('/store', [ClassTimetableController::class, 'store'])->middleware('permission:school_class_create');
        Route::get('/edit/{id}', [ClassTimetableController::class, 'edit'])->middleware('permission:school_class_update');
        Route::get('/edit-single/{id}', [ClassTimetableController::class, 'editSingle'])->middleware('permission:school_class_update');
        Route::post('/update/{id}', [ClassTimetableController::class, 'update'])->middleware('permission:school_class_update');
        Route::post('/update-single/{id}', [ClassTimetableController::class, 'updateSingle'])->middleware('permission:school_class_update');
        Route::get('/delete/{id}', [ClassTimetableController::class, 'destroy'])->middleware('permission:school_class_delete');
        Route::get('/trashed', [ClassTimetableController::class, 'trashed'])->middleware('permission:school_class_delete');

        Route::post('/subjects', [ClassTimetableController::class, 'getClassSubjects'])->middleware('permission:school_class_view');
        Route::post('/add', [ClassTimetableController::class, 'insertOrUpdate'])->middleware('permission:school_class_create');


        // Route::get('/list', [ClassTimetableController::class, 'index']);
        // Route::get('/create', [ClassTimetableController::class, 'create']);
        // Route::post('/store', [ClassTimetableController::class, 'store']);
        // Route::get('/edit/{id}', [ClassTimetableController::class, 'edit']);
        // Route::get('/edit-single/{id}', [ClassTimetableController::class, 'editSingle']);
        // Route::post('/update/{id}', [ClassTimetableController::class, 'update']);
        // Route::post('/update-single/{id}', [ClassTimetableController::class, 'updateSingle']);
        // Route::get('/delete/{id}', [ClassTimetableController::class, 'destroy']);
        // Route::get('/trashed', [ClassTimetableController::class, 'trashed']);

        // Route::post('/subjects', [ClassTimetableController::class, 'getClassSubjects']);
        // Route::post('/add', [ClassTimetableController::class, 'insertOrUpdate']);
    });

    // Assign Class Teacher URLs
    Route::group(['prefix' => 'class-teacher', 'middleware' => ['permission:school_class_view']], function () {
        Route::get('/list', [ClassTeacherController::class, 'index'])->middleware('permission:school_class_view');
        Route::get('/create', [ClassTeacherController::class, 'create'])->middleware('permission:school_class_create');
        Route::post('/store', [ClassTeacherController::class, 'store'])->middleware('permission:school_class_create');
        Route::get('/edit/{id}', [ClassTeacherController::class, 'edit'])->middleware('permission:school_class_update');
        Route::get('/edit-single/{id}', [ClassTeacherController::class, 'editSingle'])->middleware('permission:school_class_update');
        Route::post('/update/{id}', [ClassTeacherController::class, 'update'])->middleware('permission:school_class_update');
        Route::post('/update-single/{id}', [ClassTeacherController::class, 'updateSingle'])->middleware('permission:school_class_update');
        Route::get('/delete/{id}', [ClassTeacherController::class, 'destroy'])->middleware('permission:school_class_delete');
        Route::get('/trashed', [ClassTeacherController::class, 'trashed'])->middleware('permission:school_class_delete');

        // Route::get('/list', [ClassTeacherController::class, 'index']);
        // Route::get('/create', [ClassTeacherController::class, 'create']);
        // Route::post('/store', [ClassTeacherController::class, 'store']);
        // Route::get('/edit/{id}', [ClassTeacherController::class, 'edit']);
        // Route::get('/edit-single/{id}', [ClassTeacherController::class, 'editSingle']);
        // Route::post('/update/{id}', [ClassTeacherController::class, 'update']);
        // Route::post('/update-single/{id}', [ClassTeacherController::class, 'updateSingle']);
        // Route::get('/delete/{id}', [ClassTeacherController::class, 'destroy']);
        // Route::get('/trashed', [ClassTeacherController::class, 'trashed']);
    });

    // Examinations
    Route::group(['prefix' => 'examinations', 'middleware' => ['permission:examination_view']], function () {
        Route::get('/exams-list', [ExaminationController::class, 'index'])->middleware('permission:examination_view');
        Route::get('/create-exams', [ExaminationController::class, 'create'])->middleware('permission:examination_create');
        Route::post('/store-exams', [ExaminationController::class, 'store'])->middleware('permission:examination_create');
        Route::get('/exams-edit/{id}', [ExaminationController::class, 'edit'])->middleware('permission:examination_update');
        Route::post('/exams-update/{id}', [ExaminationController::class, 'update'])->middleware('permission:examination_update');
        Route::get('/delete-exam/{id}', [ExaminationController::class, 'destroy'])->middleware('permission:examination_delete');
        Route::get('/trashed-exams', [ExaminationController::class, 'trashed'])->middleware('permission:examination_view');
        Route::get('/scheduled-exams', [ExaminationController::class, 'examSchedule'])->middleware('permission:examination_view');
        Route::post('/store-scheduled-exams', [ExaminationController::class, 'storeExamSchedule'])->middleware('permission:examination_create');
        Route::get('/create-scheduled-exams', [ExaminationController::class, 'createScheduleExam'])->middleware('permission:examination_create');

        // Marks Registration
        Route::get('/subject-marks', [ExaminationController::class, 'SubjectMarks'])->middleware('permission:examination_view');
        Route::post('/subject-marks', [ExaminationController::class, 'storeSubjectMarks'])->middleware('permission:examination_create');
        Route::post('/store-single-subject-marks', [ExaminationController::class, 'storeSingleSubjectMarks'])->middleware('permission:examination_create');

        // Route::get('/exams-list', [ExaminationController::class, 'index']);
        // Route::get('/create-exams', [ExaminationController::class, 'create']);
        // Route::post('/store-exams', [ExaminationController::class, 'store']);
        // Route::get('/exams-edit/{id}', [ExaminationController::class, 'edit']);
        // Route::post('/exams-update/{id}', [ExaminationController::class, 'update']);
        // Route::get('/delete-exam/{id}', [ExaminationController::class, 'destroy']);
        // Route::get('/trashed-exams', [ExaminationController::class, 'trashed']);
        // Route::get('/scheduled-exams', [ExaminationController::class, 'examSchedule']);
        // Route::post('/store-scheduled-exams', [ExaminationController::class, 'storeExamSchedule']);
        // Route::get('/create-scheduled-exams', [ExaminationController::class, 'createScheduleExam']);

        // // Marks Registeratino
        // Route::get('/subject-marks', [ExaminationController::class, 'SubjectMarks']);
        // Route::post('/subject-marks', [ExaminationController::class, 'storeSubjectMarks']);
        // Route::post('/store-single-subject-marks', [ExaminationController::class, 'storeSingleSubjectMarks']);
    });

    // Attendance
    Route::group(['prefix' => 'attendance', 'middleware' => ['permission:attendance_view']], function () {
        Route::get('/student-attendance', [AttendanceController::class, 'studentAttendance'])->middleware(['permission:attendance_view']);
        Route::post('/store-student-attendance', [AttendanceController::class, 'storeStudentAttendance'])->middleware(['permission:attendance_create']);
        Route::get('/student-attendance-report', [AttendanceController::class, 'studentAttendanceReport'])->middleware(['permission:attendance_view']);
    });

    // Communicate
    Route::group(['prefix' => 'communicate', 'middleware' => ['permission:communicate_view']], function () {
        Route::group(['prefix' => 'notice-board'], function () {
            Route::get('/list', [CommunicateController::class, 'index'])->middleware('permission:communicate_view');
            Route::get('/create', [CommunicateController::class, 'create'])->middleware('permission:communicate_create');
            Route::post('/store', [CommunicateController::class, 'store'])->middleware('permission:communicate_create');
            Route::get('/edit/{id}', [CommunicateController::class, 'edit'])->middleware('permission:communicate_update');
            Route::post('/update/{id}', [CommunicateController::class, 'update'])->middleware('permission:communicate_update');
            Route::get('/delete/{id}', [CommunicateController::class, 'destroy'])->middleware('permission:communicate_delete');
            Route::get('/trashed', [CommunicateController::class, 'trashed'])->middleware('permission:communicate_delete');

            // Route::get('/list', [CommunicateController::class, 'index']);
            // Route::get('/create', [CommunicateController::class, 'create']);
            // Route::post('/store', [CommunicateController::class, 'store']);
            // Route::get('/edit/{id}', [CommunicateController::class, 'edit']);
            // Route::post('/update/{id}', [CommunicateController::class, 'update']);
            // Route::get('/delete/{id}', [CommunicateController::class, 'destroy']);
            // Route::get('/trashed', [CommunicateController::class, 'trashed']);
        });
        Route::group(['prefix' => 'emails'], function () {
            Route::get('/search-user', [CommunicateController::class, 'searchUser'])->middleware('permission:communicate_view');
            Route::get('/send', [CommunicateController::class, 'sendEmail'])->middleware('permission:communicate_create');
            Route::post('/send', [CommunicateController::class, 'sendToUser'])->middleware('permission:communicate_create');
        });
    });

    // Fee Collection
    Route::group(['prefix' => 'fee-collection', 'middleware' => ['permission:fee_collection_view']], function () {
        Route::get('/list', [FeeCollectionController::class, 'index'])->middleware('permission:fee_collection_view');
        Route::get('/report', [FeeCollectionController::class, 'feeCollectionReport'])->middleware('permission:fee_collection_view');
        Route::get('/collect-fee/{id}', [FeeCollectionController::class, 'create'])->middleware('permission:fee_collection_update');
        Route::post('/collect-fee/{id}', [FeeCollectionController::class, 'store'])->middleware('permission:fee_collection_update');

        // Route::get('/list', [FeeCollectionController::class, 'index']);
        // Route::get('/report', [FeeCollectionController::class, 'feeCollectionReport']);
        // Route::get('/collect-fee/{id}', [FeeCollectionController::class, 'create']);
        // Route::post('/collect-fee/{id}', [FeeCollectionController::class, 'store']);
    });

    // Expense
    Route::group(['prefix' => 'expenses'], function () {
        // Expense Head
        Route::get('/heads/list', [ExpenseHeadController::class, 'index'])->middleware('permission:expense_head_view');
        Route::get('/heads/create', [ExpenseHeadController::class, 'create'])->middleware('permission:expense_head_create');
        Route::post('/heads/store', [ExpenseHeadController::class, 'store'])->middleware('permission:expense_head_create');
        Route::get('/heads/edit/{id}', [ExpenseHeadController::class, 'edit'])->middleware('permission:expense_head_update');
        Route::post('/heads/update/{id}', [ExpenseHeadController::class, 'update'])->middleware('permission:expense_head_update');


        // Expenses
        Route::get('/list', [ExpenseController::class, 'index'])->middleware('permission:expense_view');
        Route::get('/create', [ExpenseController::class, 'create'])->middleware('permission:expense_create');
        Route::post('/store', [ExpenseController::class, 'store'])->middleware('permission:expense_create');
        Route::get('/edit/{id}', [ExpenseController::class, 'edit'])->middleware('permission:expense_update');
        Route::post('/update/{id}', [ExpenseController::class, 'update'])->middleware('permission:expense_update');

        // Route::get('/list', [ExpenseController::class, 'index']);
        // Route::get('/report', [ExpenseController::class, 'feeCollectionReport']);
        // Route::get('/collect-fee/{id}', [ExpenseController::class, 'create']);
        // Route::post('/collect-fee/{id}', [ExpenseController::class, 'store']);
    });

    // Homework
    Route::group(['prefix' => 'home-work', 'middleware' => ['permission:home_work_view']], function () {
        Route::get('/list', [HomeWorkController::class, 'index'])->middleware('permission:home_work_view');
        Route::get('/create', [HomeWorkController::class, 'create'])->middleware('permission:home_work_create');
        Route::post('/store', [HomeWorkController::class, 'store'])->middleware('permission:home_work_create');
        Route::get('/edit/{id}', [HomeWorkController::class, 'edit'])->middleware('permission:home_work_update');
        Route::post('/update/{id}', [HomeWorkController::class, 'update'])->middleware('permission:home_work_update');
        Route::get('/delete/{id}', [HomeWorkController::class, 'destroy'])->middleware('permission:home_work_delete');
        Route::get('/trashed', [HomeWorkController::class, 'trashed'])->middleware('permission:home_work_delete');
        Route::get('/submitted-list', [HomeWorkController::class, 'submittedHomeWorkList'])->middleware('permission:home_work_view');
        Route::get('/submitted/{id}', [HomeWorkController::class, 'submittedHomeWork'])->middleware('permission:home_work_view');
        Route::get('/get-class-subjects', [HomeWorkController::class, 'getClassSubjects'])->middleware('permission:home_work_view');

        // Route::get('/list', [HomeWorkController::class, 'index']);
        // Route::get('/create', [HomeWorkController::class, 'create']);
        // Route::post('/store', [HomeWorkController::class, 'store']);
        // Route::get('/edit/{id}', [HomeWorkController::class, 'edit']);
        // Route::post('/update/{id}', [HomeWorkController::class, 'update']);
        // Route::get('/delete/{id}', [HomeWorkController::class, 'destroy']);
        // Route::get('/trashed', [HomeWorkController::class, 'trashed']);
        // Route::get('/submitted-list', [HomeWorkController::class, 'submittedHomeWorkList']);
        // Route::get('/submitted/{id}', [HomeWorkController::class, 'submittedHomeWork']);
        // Route::get('/get-class-subjects', [HomeWorkController::class, 'getClassSubjects']);
    });

    // Homework
    Route::group(['prefix' => 'settings', 'middleware' => ['permission:setting_view']], function () {
        Route::get('', [SettingController::class, 'index'])->middleware('permission:setting_view');
        Route::post('/update/{id}', [SettingController::class, 'update'])->middleware('permission:setting_update');
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
Route::group(['prefix' => 'student'], function () {
    // Route::group(['middleware' => ['otp_verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::post('/visitor/store', [StudentDetailController::class, 'storeVisitor']);
    // });
    Route::group(['middleware' => ['is_active', 'student']], function () {
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
