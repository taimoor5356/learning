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

    // static public function getClassSubjectRecord($classId, $subjectId, $dayId)
    // {
    //     return self::where('class_id', $classId)->where('subject_id', $subjectId)->where('week_days_id', $dayId);
    // }

    static public function getClassSubjectRecord($classId, $subjectId)
    {
        return self::where('class_id', $classId)->where('subject_id', $subjectId);
    }
}
