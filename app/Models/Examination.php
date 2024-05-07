<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Examination extends Model
{
    use HasFactory, SoftDeletes;

    static public function getExams() {
        $exams = self::with('user');
        if (!empty(Request::get('name'))) {
            $exams = $exams->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('note'))) {
            $exams = $exams->where('note', 'LIKE', '%' . Request::get('note') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $exams = $exams->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $exams = $exams->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $exams->orderBy('id', 'desc');
    }

    static public function getTrashedExams() {
        return self::with('user')->onlyTrashed()->orderBy('id', 'desc');
    }

    static public function getSingleExam($examId) {
        return self::find($examId);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
