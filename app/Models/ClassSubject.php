<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class ClassSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function getStatusAttribute($value)
    {
        return $value == 0 ? 'In Active' : 'Active';
    }

    static public function getClassSubjects() {
        $classSubjects = self::with('user', 'class', 'subject');
        if (!empty(Request::get('class_name'))) {
            $classSubjects->whereHas('class', function ($query) {
                $query->where('name', 'LIKE', '%' . Request::get('class_name') . '%');
            });
        }
        if (!empty(Request::get('subject_name'))) {
            $classSubjects->whereHas('subject', function ($query) {
                $query->where('name', 'LIKE', '%' . Request::get('subject_name') . '%');
            });
        }
        if (!empty(Request::get('from_date'))) {
            $classSubjects = $classSubjects->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $classSubjects = $classSubjects->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $classSubjects->orderBy('id', 'desc');
    }

    static function getSingleClassSubjects($classId) {
        return self::with('class', 'subject')->where('class_id', $classId);
    }

    static function getSingleStudentClassSubjectsCount($classId) {
        return self::with('class', 'subject')->where('class_id', $classId);
    }

    static public function getSingleClassSubject($id) {
        return self::with('user', 'class', 'subject')->find($id);
    }

    static public function getTrashedClassSubjects() {
        return self::with('user', 'class', 'subject')->onlyTrashed()->orderBy('id', 'desc');
    }

    static function getSingleAlreadyAssigned($classId, $subjectId) {
        return self::where('class_id', $classId)->where('subject_id', $subjectId)->first();
    }

    static function getAssignedSubjectId($classId) {
        return self::where('class_id', $classId);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function class() {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
