<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeWork extends Model
{
    use HasFactory, SoftDeletes;

    static public function getAllTeacherHomeWork($classIds)
    {
        return HomeWork::whereIn('class_id', $classIds)->orderBy('id', 'desc');
    }

    static public function getAllStudentHomeWork($classId, $userId)
    {
        return HomeWork::with('user', 'class', 'subject', 'submitted_home_work')
            ->where('class_id', $classId)
            ->whereNotIn('id', function ($q) use ($userId) {
                $q->select('homework_id')
                    ->from('submitted_home_works')
                    ->where('user_id', $userId);
            })
            ->orderBy('id', 'desc');
    }

    static public function getAllHomeWork()
    {
        return HomeWork::orderBy('id', 'desc');
    }

    static public function getAllTrashedHomeWork()
    {
        return HomeWork::onlyTrashed()->orderBy('id', 'desc');
    }

    static public function getSingleHomeWork($id)
    {
        return HomeWork::where('id', $id);
    }

    public function getDocument()
    {
        if (!empty($this->document) && file_exists('public/images/homework/' . $this->document)) {
            return url('public/images/homework/' . $this->document);
        } else {
            return '';
        }
    }

    public function batch()
    {
        return $this->belongsTo(SchoolClass::class, 'batch_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function submitted_home_work()
    {
        return $this->hasMany(SubmittedHomeWork::class, 'homework_id', 'id');
    }
}
