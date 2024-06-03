<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static public function alreadyAssigned($userId, $batchId, $subjectId)
    {
        return self::where('user_id', $userId)->where('batch_id', $batchId)->where('subject_id', $subjectId)->first();
    }

    static function getSingleBatchSubjects($userId) {
        return self::with('batch', 'subject')->where('user_id', $userId);
    }

    static function getSingleBatchWiseSubjects($userId, $batchId) {
        return self::with('batch', 'subject')->where('user_id', $userId)->where('batch_id', $batchId);
    }

    //Relations
    public function batch() {
        return $this->belongsTo(SchoolClass::class, 'batch_id', 'id');
    }
    
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
