<?php

namespace App\Http\Controllers;

use App\Mail\SendUserEmail;
use App\Models\Communicate;
use App\Models\NoticeBoard;
use App\Models\NoticeBoardUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommunicateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Notice Board';
        $data['records'] = NoticeBoard::getAllNotices()->paginate(25);
        return view('admin.communicate.notice_board.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'CreateNotice Board';
        return view('admin.communicate.notice_board.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $notice = new NoticeBoard();
            $notice->title = $request->title;
            $notice->notice_date = $request->notice_date;
            $notice->publish_date = $request->publish_date;
            $notice->message = $request->message;
            $notice->created_by = Auth::user()->id;
            $notice->save(); //remove all save

            if (!empty($request->message_to)) {
                foreach ($request->message_to as $userId) {
                    $noticeBoardUser = new NoticeBoardUser();
                    $noticeBoardUser->notice_board_id = $notice->id;
                    $noticeBoardUser->message_to = $userId;
                    $noticeBoardUser->save(); //remove all save
                }
            }

            return redirect('admin/communicate/notice-board/list')->with('success', 'Notice Board Created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Communicate $communicate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Notice';
        $data['record'] = NoticeBoard::getSingle($id)->first();
        if (isset($data['record'])) {
            return view('admin.communicate.notice_board.edit', $data);
        } else {
            return redirect()->back()->with('error', 'Notice not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $notice = NoticeBoard::find($id);
            if (isset($notice)) {
                $notice->title = $request->title;
                $notice->notice_date = $request->notice_date;
                $notice->publish_date = $request->publish_date;
                $notice->message = $request->message;
                $notice->created_by = Auth::user()->id;
                $notice->save(); //remove all save
                // delete users and add again
                if (!empty($request->message_to)) {
                    NoticeBoardUser::where('notice_board_id', $id)->delete();
                    foreach ($request->message_to as $userId) {
                        $noticeBoardUser = new NoticeBoardUser();
                        $noticeBoardUser->notice_board_id = $notice->id;
                        $noticeBoardUser->message_to = $userId;
                        $noticeBoardUser->save(); //remove all save
                    }
                }
                return redirect('admin/communicate/notice-board/list')->with('success', 'Notice Board Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Notice not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $notice = NoticeBoard::find($id);
            if (isset($notice)) {
                NoticeBoardUser::where('notice_board_id', $id)->delete();
                $notice->delete();
                return redirect('admin/communicate/notice-board/list')->with('success', 'Notice Board Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Notice not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Trashed Notices';
        $data['records'] = NoticeBoard::with(['notice_board_users' => function($q) {
            $q->onlyTrashed();
        }])->onlyTrashed()->paginate(25);
        return view('admin.communicate.notice_board.trashed', $data);
    }

    public function studentNoticeBoard()
    {
        $data['header_title'] = 'Notice Board';
        $data['records'] = NoticeBoard::getUserRecords(Auth::user()->user_type)->paginate(25);
        return view('student.communicate.notice_board.index', $data);
    }

    public function teacherNoticeBoard()
    {
        $data['header_title'] = 'Notice Board';
        $data['records'] = NoticeBoard::getUserRecords(Auth::user()->user_type)->paginate(25);
        return view('teacher.communicate.notice_board.index', $data);
    }

    public function sendEmail(Request $request)
    {
        $data['header_title'] = 'Send Email';
        $data['records'] = NoticeBoard::getAllNotices()->paginate(25);
        return view('admin.communicate.send_email', $data);
    }

    public function sendToUser(Request $request)
    {
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
            $user->email_subject = $request->subject;
            $user->email_message = $request->message;
            Mail::to($user->email)->send(new SendUserEmail($user));
        }
        if (!empty($request->message_to)) {
            foreach ($request->message_to as $userType) {
                $users = User::getUsersByType($userType)->get();
                foreach ($users as $newUser) {
                    $newUser->email_subject = $request->subject;
                    $newUser->email_message = $request->message;
                    Mail::to($newUser->email)->send(new SendUserEmail($newUser));
                }
            }
        }
        return redirect()->back()->with('success', 'Email sent successfully');
    }

    public function searchUser(Request $request)
    {
        $usersArray = [];
        if (!empty($request->search)) {
            $users = User::searchUser($request->search)->get();
            foreach ($users as $user) {
                $userType = '';
                if ($user->user_type == 1) {
                    $userType = ' (Admin)';
                } else if ($user->user_type == 2) {
                    $userType = ' (Teacher)';
                } else if ($user->user_type == 3) {
                    $userType = ' (Student)';
                }
                $usersArray[] = [
                    'id' => $user->id,
                    'text' => $user->name . $userType,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                ];
            }
        }
        return response()->json($usersArray);
    }
}
