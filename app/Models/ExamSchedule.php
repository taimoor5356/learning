<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    static public function getSingleSchedule($id) {
        return self::with('exam', 'subject')->where('id', $id);
    }

    static public function getSingleClassSchedule($batchId) {
        return ExamSchedule::with('exam', 'subject')->where('batch_id', $batchId)->groupBy('exam_id')->orderBy('id', 'desc');
    }

    static public function getSingleExamClassSchedule($examId, $classId) {
        return ExamSchedule::with('exam', 'subject')->where('exam_id', $examId)->where('class_id', $classId);
    }

    static public function getSingleExamClassSubjectSchedule($examId, $classId, $subjectId) {
        return ExamSchedule::with('exam', 'subject')->where('exam_id', $examId)->where('class_id', $classId)->where('subject_id', $subjectId);
    }

    static public function getStudentsMarks($studentId, $examId, $classId, $subjectId) {
        return SubjectMark::getSingleRegisteredMark($studentId, $examId, $classId, $subjectId);
    }

    static public function getTeacherExams($teacherId) {
        return self::with('exam', 'class_teacher')
                ->whereHas('class_teacher', function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId);
                })
                ->groupBy('exam_id')
                ->orderBy('id', 'desc');
    }

    public function exam() {
        return $this->belongsTo(Examination::class, 'exam_id', 'id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function class_teacher() {
        return $this->belongsTo(ClassTeacher::class, 'class_id', 'class_id');
    }
}
