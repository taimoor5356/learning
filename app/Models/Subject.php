<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function getStatusAttribute($value)
    {
        return $value == 0 ? 'In Active' : 'Active';
    }

    static public function getSubjects() {
        $subjects = self::with('user');
        if (!empty(Request::get('name'))) {
            $subjects = $subjects->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        // if (!empty(Request::get('status')) && (Request::get('status') == 0 || Request::get('status') == 1)) {
        //     $subjects = $subjects->where('status',  Request::get('status'));
        // }
        if (!empty(Request::get('from_date'))) {
            $subjects = $subjects->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $subjects = $subjects->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $subjects->orderBy('id', 'desc');
    }

    static public function getSingleSubject($id) {
        return self::find($id);
    }

    static public function getTrashedSubjects() {
        return self::with('user')->onlyTrashed()->orderBy('id', 'desc');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function class_subject() {
        return $this->belongsTo(ClassSubject::class, 'subject_id', 'id');
    }
}
