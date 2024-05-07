<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    use HasFactory;

    static public function getSingleRegisteredMark($studentId, $examId, $classId, $subjectId)
    {
        return self::where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId);
    }

    static public function getStudentExams($studentId)
    {
        return self::with('exam')->where('student_id', $studentId)
                ->groupBy('exam_id');
    }

    static public function getStudentExamSubjects($examId, $studentId)
    {
        return self::with('exam', 'subject')->where('student_id', $studentId)->where('exam_id', $examId);
    }

    public function exam()
    {
        return $this->belongsTo(Examination::class, 'exam_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
