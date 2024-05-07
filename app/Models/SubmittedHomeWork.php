<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedHomeWork extends Model
{
    use HasFactory;

    static public function getHomeWorkList() {
        return SubmittedHomeWork::with('user', 'home_work')->orderBy('id', 'desc');
    }

    static public function getAllSubmittedHomeWork() {
        return SubmittedHomeWork::with('home_work')->orderBy('id', 'desc');
    }
    
    static public function getSingleSubmittedHomeWork($id) {
        return SubmittedHomeWork::with('home_work')->where('homework_id', $id);
    }

    static public function getStudentSubmittedHomeWork($userId) {
        return SubmittedHomeWork::with('home_work')->where('user_id', $userId)->orderBy('id', 'desc');
    }

    public function home_work() {
        return $this->belongsTo(HomeWork::class, 'homework_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDocument()
    {
        if (!empty($this->document) && file_exists('public/images/homework/' . $this->document)) {
            return url('public/images/homework/' . $this->document);
        } else {
            return '';
        }
    }
}
