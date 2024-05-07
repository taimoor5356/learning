<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function otp()
    {
        return view('auth.otp');
    }
    public function postOtp(Request $request)
    {
        request()->validate([
            'otp' => 'required'
        ]);
        $token = Session::get('otp_token');
        $user = User::where('otp_token', $token)->first();
        $user->otp_verified = 1;
        $user->save();
        return redirect('')->with('success', 'OTP verified successfully. Contact your administrator now');
    }
    public function signup()
    {
        return view('auth.register');
    }
    public function postSignup(Request $request)
    {
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
        return redirect('otp')->with('success', 'OTP send to your email address');
    }
    public function login()
    {
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
        return view('auth.login');
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
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function forgotPassword()
    {
        return view('auth.forgot_password');
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
