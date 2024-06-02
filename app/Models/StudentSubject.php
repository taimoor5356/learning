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
}
