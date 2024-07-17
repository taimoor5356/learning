<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetable extends Model
{
    use HasFactory;

    static public function alreadyAssignedClassTimetable($classId, $subjectId, $date)
    {
        return self::where('class_id', $classId)->where('subject_id', $subjectId)->where('date', $date);
    }

    static function getSingleSubjectBatchWiseTimetable($batchId, $subjectId) {
        return self::where('batch_id', $batchId)->where('subject_id', $subjectId);
    }

    static public function getClassSubjectRecord($classId, $subjectId)
    {
        return self::where('class_id', $classId)->where('subject_id', $subjectId);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
