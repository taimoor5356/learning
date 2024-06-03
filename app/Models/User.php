<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Request;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getUsersCount($type)
    {
       return self::where('user_type', $type)->count();
    }

    static public function getAdmins()
    {
        $admins = self::select('users.*')->where('user_type', 1);
        if (!empty(Request::get('name'))) {
            $admins = $admins->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $admins = $admins->where('email', 'LIKE', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $admins = $admins->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $admins = $admins->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $admins = $admins->orderBy('id', 'desc');
        return $admins;
    }

    static public function getTeachers()
    {
        $teachers = self::where('user_type', 2);
        if (!empty(Request::get('name'))) {
            $teachers = $teachers->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $teachers = $teachers->where('email', 'LIKE', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $teachers = $teachers->where('gender', Request::get('gender'));
        }
        if (!empty(Request::get('mobile_number'))) {
            $teachers = $teachers->where('mobile_number', 'LIKE', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $teachers = $teachers->where('blood_group', Request::get('blood_group'));
        }
        if (!empty(Request::get('marital_status'))) {
            $teachers = $teachers->where('marital_status', Request::get('marital_status'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 10) ? 0 : 1;
            $teachers = $teachers->where('status', $status);
        }
        if (!empty(Request::get('admission_date'))) {
            $teachers = $teachers->whereDate('admission_date', Request::get('admission_date'));
        }
        if (!empty(Request::get('from_date'))) {
            $teachers = $teachers->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $teachers = $teachers->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $teachers = $teachers->orderBy('id', 'desc');
        return $teachers;
    }

    static public function getStudents()
    {
        $students = self::whereIn('user_type', [3, 10]);
        if (!empty(Request::get('user_type'))) {
            $students = $students->where('user_type', Request::get('user_type'));
        }
        if (!empty(Request::get('name'))) {
            $students = $students->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $students = $students->where('email', 'LIKE', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('batch_number'))) {
            $students = $students->where('batch_number', '=', Request::get('batch_number'));
        }
        if (!empty(Request::get('admission_number'))) {
            $students = $students->where('admission_number', 'LIKE', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $students = $students->where('roll_number', 'LIKE', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('class_id'))) {
            $students = $students->whereHas('class', function ($q) {
                $q->where('id', Request::get('class_id'));
            });
        }
        if (!empty(Request::get('gender'))) {
            $students = $students->where('gender', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $students = $students->where('caste', Request::get('caste'));
        }
        if (!empty(Request::get('religion'))) {
            $students = $students->where('religion', Request::get('religion'));
        }
        if (!empty(Request::get('mobile_number'))) {
            $students = $students->where('mobile_number', 'LIKE', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $students = $students->where('blood_group', Request::get('blood_group'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 10) ? 0 : 1;
            $students = $students->where('status', $status);
        }
        if (!empty(Request::get('admission_date'))) {
            $students = $students->whereDate('admission_date', Request::get('admission_date'));
        }
        if (!empty(Request::get('from_date'))) {
            $students = $students->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $students = $students->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $students = $students->orderBy('id', 'desc');
        return $students;
    }

    static public function getFeeCollectedStudents()
    {
        $students = self::with('class')->where('user_type', 3);
        if (!empty(Request::get('student_name'))) {
            $students = $students->where('name', 'LIKE', '%' . Request::get('student_name') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $students = $students->where('roll_number', 'LIKE', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $students = $students->where('admission_number', 'LIKE', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('class_id'))) {
            $students = $students->whereHas('class', function ($q) {
                $q->where('id', Request::get('class_id'));
            });
        }
        if (!empty(Request::get('from_date'))) {
            $students = $students->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $students = $students->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $students = $students->orderBy('id', 'desc');
        return $students;
    }

    static public function getPaidAmount($userId, $classid)
    {
        return SubmittedFee::getStudentPaidFees($userId, $classid);
    }

    static public function getStudentClass($classId)
    {
        return self::where('user_type', 3)->where('batch_number', $classId)->orderBy('id', 'desc');
    }


    static public function getStudentSingleClass($userId)
    {
        return self::with('class', 'batch')->where('user_type', 3)->where('id', $userId);
    }

    static public function getTeacherStudentsCount($teacherId)
    {
        $students = self::select('users.*')
        ->join('school_classes', 'school_classes.id', '=', 'users.class_id')
        ->join('class_teachers', 'class_teachers.class_id', '=', 'school_classes.id')
        ->where('class_teachers.teacher_id', $teacherId)
        ->where('users.user_type', '=', 3)
        // ->groupBy('users.id')
        ->count();
        return $students;
    }

    static public function getTeacherStudents($teacherId)
    {
        $students = self::select('users.*', 'school_classes.name as class_name')
        ->join('school_classes', 'school_classes.id', '=', 'users.batch_number')
        ->join('class_teachers', 'class_teachers.class_id', '=', 'school_classes.id')
        ->where('class_teachers.teacher_id', $teacherId)
        ->where('users.user_type', '=', 3)
        ->groupBy('users.id');

        if (!empty(Request::get('name'))) {
            $students = $students->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $students = $students->where('email', 'LIKE', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $students = $students->where('admission_number', 'LIKE', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $students = $students->where('roll_number', 'LIKE', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('class_id'))) {
            $students = $students->whereHas('class', function ($q) {
                $q->where('id', Request::get('class_id'));
            });
        }
        if (!empty(Request::get('gender'))) {
            $students = $students->where('gender', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $students = $students->where('caste', Request::get('caste'));
        }
        if (!empty(Request::get('religion'))) {
            $students = $students->where('religion', Request::get('religion'));
        }
        if (!empty(Request::get('mobile_number'))) {
            $students = $students->where('mobile_number', 'LIKE', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $students = $students->where('blood_group', Request::get('blood_group'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 10) ? 0 : 1;
            $students = $students->where('status', $status);
        }
        if (!empty(Request::get('admission_date'))) {
            $students = $students->whereDate('admission_date', Request::get('admission_date'));
        }
        if (!empty(Request::get('from_date'))) {
            $students = $students->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $students = $students->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $students = $students->orderBy('id', 'desc');
        return $students;
    }

    static public function getTrashedAdmins()
    {
        return self::onlyTrashed()->where('user_type', 1)->orderBy('id', 'desc');
    }

    static public function getTrashedStudents()
    {
        return self::onlyTrashed()->where('user_type', 3)->orderBy('id', 'desc');
    }

    static public function getTrashedTeachers()
    {
        return self::onlyTrashed()->where('user_type', 2)->orderBy('id', 'desc');
    }

    static public function getSingleUser($id)
    {
        return self::with('class')->where('id', $id);
    }

    static public function getSingleEmail($email)
    {
        return self::where('email', $email)->first();
    }

    static public function getSingleToken($token)
    {
        return self::where('remember_token', $token)->first();
    }

    static public function getAttendance($userId, $classId, $attendanceDate)
    {
        return Attendance::checkAlreadyMarkedAttendance($userId, $classId, $attendanceDate);
    }

    static public function getUsersByType($userType)
    {
        return self::where('user_type', $userType);
    }

    static public function searchUser($searchValue)
    {
        return self::where('name', 'LIKE', '%'. $searchValue. '%')->orWhere('email', 'LIKE', '%'. $searchValue. '%')->orWhere('admission_number', 'LIKE', '%'. $searchValue. '%')->orWhere('roll_number', 'LIKE', '%'. $searchValue. '%')->orWhere('mobile_number', 'LIKE', '%'. $searchValue. '%')->limit(5);
    }

    static public function submitted_fee($id, $classId)
    {
        return SubmittedFee::where('user_id', '=', $id)->where('class_id', $classId);
    }

    // Relations

    public function getProfilePic()
    {
        if (!empty($this->profile_pic) && file_exists('public/images/profile/' . $this->profile_pic)) {
            return url('public/images/profile/' . $this->profile_pic);
        } else {
            return url('public/images/avatar.png');
        }
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(SchoolClass::class, 'batch_number', 'id');
    }

    public function fee()
    {
        return $this->hasMany(SubmittedFee::class, 'user_id', 'id');
    }
}
