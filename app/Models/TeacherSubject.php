<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    static public function alreadyAssigned($userId, $batchId, $subjectId)
    {
        return self::where('user_id', $userId)->where('batch_id', $batchId)->where('subject_id', $subjectId)->first();
    }

    static function getSingleTeacherWiseSubjects($userId) {
        return self::with('batch', 'subject')->where('user_id', $userId);
    }

    static function getSingleBatchSubjects($userId) {
        return self::with('batch', 'subject')->where('user_id', $userId);
    }

    static function getSingleBatchWiseSubjects($userId, $batchId) {
        return self::with('batch', 'subject')->where('user_id', $userId)->where('batch_id', $batchId);
    }

    static public function getMyClassSubjectTimings($classId, $subjectId) {
        $dayOfWeek = DaysOfWeek::getWeekDayUsingName(date('l'));
        $classSubjectsRecord = ClassSubjectTimetable::getClassSubjectRecord($classId, $subjectId, $dayOfWeek->id)->first();
        return $classSubjectsRecord;
    }

    //Relations
    public function batch() {
        return $this->belongsTo(SchoolClass::class, 'batch_id', 'id');
    }
    
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
