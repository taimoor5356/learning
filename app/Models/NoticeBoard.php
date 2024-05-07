<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class NoticeBoard extends Model
{
    use HasFactory, SoftDeletes;

    static public function getSingle($id) {
        return self::with('user', 'notice_board_users.user')->where('id', $id);
    }

    static public function getAllNotices() {
        $notices = NoticeBoard::with('user', 'notice_board_users.user')->orderBy('id', 'desc');
        if (!empty(Request::get('title'))) {
            $notices = $notices->where('title', 'LIKE', '%' . Request::get('title') . '%');
        }
        if (!empty(Request::get('notice_from_date'))) {
            $notices = $notices->whereDate('notice_date', '>=', Request::get('notice_from_date'));
        }
        if (!empty(Request::get('notice_to_date'))) {
            $notices = $notices->whereDate('notice_date', '<=', Request::get('notice_to_date'));
        }
        if (!empty(Request::get('publish_from_date'))) {
            $notices = $notices->whereDate('publish_date', '>=', Request::get('publish_from_date'));
        }
        if (!empty(Request::get('publish_from_date'))) {
            $notices = $notices->whereDate('publish_date', '<=', Request::get('publish_from_date'));
        }
        return $notices;
    }

    static public function getTeacherNoticeCount($teacherId) {
        $notices = NoticeBoardUser::where('message_to', $teacherId)->count();
        return $notices;
    }

    static public function getStudentNoticeCount($studentId) {
        $notices = NoticeBoardUser::where('message_to', $studentId)->count();
        return $notices;
    }

    static public function getUserRecords($userTypeId) {
        $notices = NoticeBoard::with('user', 'notice_board_users.user')
            ->whereHas('notice_board_users', function ($query) use ($userTypeId) {
                $query->where('message_to', $userTypeId);
            })
            ->orderBy('id', 'desc');
        if (!empty(Request::get('title'))) {
            $notices = $notices->where('title', 'LIKE', '%' . Request::get('title') . '%');
        }
        if (!empty(Request::get('notice_from_date'))) {
            $notices = $notices->whereDate('notice_date', '>=', Request::get('notice_from_date'));
        }
        if (!empty(Request::get('notice_to_date'))) {
            $notices = $notices->whereDate('notice_date', '<=', Request::get('notice_to_date'));
        }
        if (!empty(Request::get('publish_from_date'))) {
            $notices = $notices->whereDate('publish_date', '>=', Request::get('publish_from_date'));
        }
        if (!empty(Request::get('publish_from_date'))) {
            $notices = $notices->whereDate('publish_date', '<=', Request::get('publish_from_date'));
        }
        return $notices;
    }

    public function getSingleMessageUser($noticeBoardId, $userId) {
        return NoticeBoardUser::where('notice_board_id', $noticeBoardId)->where('message_to', $userId)->first();
    }

    public function notice_board_users() {
        return $this->hasMany(NoticeBoardUser::class, 'notice_board_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
