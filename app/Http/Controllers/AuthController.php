<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function otp()
    {
        $settings = systemSettings();
        $texts = [];
        if (!empty($settings)) {
            $texts = [
                $settings->school_login_page_notification_01,
                $settings->school_login_page_notification_02,
                $settings->school_login_page_notification_03,
            ];
        }
        $totalLength = 0;
        foreach ($texts as $text) {
            $totalLength += strlen($text);
        }
        return view('auth.otp', compact('texts', 'totalLength'));
    }
    public function resendOTP()
    {
        $token = Session::get('otp_token');
        $user = User::where('otp_token', $token)->first();
        $user->otp = mt_rand(1000, 9999);
        $user->save();
        Mail::to($user->email)->send(new OtpMail($user));
        return redirect()->back()->with('success', 'OTP sent to your email address');
    }
    public function postOtp(Request $request)
    {
        request()->validate([
            'otp' => 'required'
        ]);
        $token = Session::get('otp_token');
        $user = User::where('otp_token', $token)->where('otp', $request->otp)->first();
        if (isset($user)) {
            $user->otp_verified = 1;
            $user->save();
            return redirect('')->with('success', 'OTP verified successfully. Contact your administrator now');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP');
        }
    }
    public function signup()
    {
        $settings = systemSettings();
        $texts = [];
        if (!empty($settings)) {
            $texts = [
                $settings->school_login_page_notification_01,
                $settings->school_login_page_notification_02,
                $settings->school_login_page_notification_03,
            ];
        }
        $totalLength = 0;
        foreach ($texts as $text) {
            $totalLength += strlen($text);
        }
        return view('auth.register', compact('texts', 'totalLength'));
    }
    public function postSignup(Request $request)
    {
        DB::beginTransaction();
        try {
            request()->validate([
                'email' => 'required|email|unique:users'
            ]);
            $token = Str::random(40);
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->otp = mt_rand(1000, 9999);
            $user->otp_token = $token;
            $user->status = 0;
            $user->save();
            Session::put('otp_token', $token);
            Mail::to($user->email)->send(new OtpMail($user));
            DB::commit();
            return redirect('otp')->with('success', 'OTP sent to your email address');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function login()
    {
        $settings = systemSettings();
        $texts = [];
        if (!empty($settings)) {
            $texts = [
                $settings->school_login_page_notification_01,
                $settings->school_login_page_notification_02,
                $settings->school_login_page_notification_03,
            ];
        }
        $totalLength = 0;
        foreach ($texts as $text) {
            $totalLength += strlen($text);
        }
        if (!empty(Auth::check())) {
            $userType = Auth::user()->user_type;
            if ($userType == 1) {
                return redirect('admin/dashboard');
            } else if ($userType == 2) {
                return redirect('teacher/dashboard');
            } else if ($userType == 3) {
                return redirect('student/dashboard');
            } else if ($userType == 4) {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login', compact('texts', 'totalLength'));
    }
    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $userType = Auth::user()->user_type;
            if ($userType == 1) {
                return redirect('admin/dashboard');
            } else if ($userType == 2) {
                return redirect('teacher/dashboard');
            } else if ($userType == 3) {
                return redirect('student/dashboard');
            } else if ($userType == 4) {
                return redirect('parent/dashboard');
            } else if ($userType == 10) {
                return redirect('')->with('error', 'Please wait for the approval');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function forgotPassword()
    {
        $settings = systemSettings();
        $texts = [];
        if (!empty($settings)) {
            $texts = [
                $settings->school_login_page_notification_01,
                $settings->school_login_page_notification_02,
                $settings->school_login_page_notification_03,
            ];
        }
        $totalLength = 0;
        foreach ($texts as $text) {
            $totalLength += strlen($text);
        }
        return view('auth.forgot_password', compact('texts', 'totalLength'));
    }
    public function forgetPassword(Request $request)
    {
        $user = User::getSingleEmail($request->email);
        if (isset($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Please check your email');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }
    public function resetPassword($token)
    {
        $settings = systemSettings();
        $texts = [];
        if (!empty($settings)) {
            $texts = [
                $settings->school_login_page_notification_01,
                $settings->school_login_page_notification_02,
                $settings->school_login_page_notification_03,
            ];
        }
        $totalLength = 0;
        foreach ($texts as $text) {
            $totalLength += strlen($text);
        }
        $data['texts'] = $texts;
        $data['totalLength'] = $totalLength;
        $user = User::getSingleToken($token);
        if (isset($user)) {
            $data['user'] = $user;
            return view('auth.reset_password', $data);
        } else {
            abort(404);
        }
    }
    public function postResetPassword(Request $request, $token)
    {
        if ($request->password == $request->confirm_password) {
            $user = User::getSingleToken($token);
            if (isset($user)) {
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(30);
                $user->save();
                return redirect('')->with('success', 'Password reset successfully');
            } else {
                return redirect()->back()->with('error', 'User does not exist');
            }
        } else {
            return redirect()->back()->with('error', 'Password & Confirm password does not match');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
