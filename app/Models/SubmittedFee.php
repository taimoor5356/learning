<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubmittedFee extends Model
{
    use HasFactory;

    static public function getFeeCollectionReport() {
        $submittedFees = self::with('class', 'user', 'created_user')->orderBy('id', 'desc');
        if (!empty(Request::get('student_name'))) {
            $submittedFees->whereHas('user', function ($q) {
                $q->where('name', 'LIKE', '%' . Request::get('student_name') . '%');
            });
        }
        if (!empty(Request::get('roll_number'))) {
            $submittedFees->whereHas('user', function ($q) {
                $q->where('roll_number',  Request::get('roll_number'));
            });
        }
        if (!empty(Request::get('class_id'))) {
            $submittedFees->where('batch_number', Request::get('class_id'));
        }
        if (!empty(Request::get('payment_type'))) {
            $submittedFees->where('payment_type', Request::get('payment_type'));
        }
        if (!empty(Request::get('from_date'))) {
            $submittedFees->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $submittedFees->whereDate('created_at', '<=', Request::get('to_date'));
        }

        return $submittedFees;
    }

    static public function getTotalCollectedFees() {
        return self::sum('paid_amount');
    }

    static public function getTotalStudentCollectedFees($studentId) {
        return self::where('user_id', $studentId)->sum('paid_amount');
    }

    static public function getTotalTodayCollectedFees() {
        return self::whereDate('created_at', now())->sum('paid_amount');
    }

    static public function getStudentFees($userId) {
        return self::with('class', 'user', 'created_user')->where('user_id', $userId)->orderBy('id', 'desc');
    }

    static public function getStudentPaidFees($userId, $classid) {
        return self::where('user_id', $userId)->where('class_id', $classid)->sum('paid_amount');
    }

    public function class() {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function created_user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
