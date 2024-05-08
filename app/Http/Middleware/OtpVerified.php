<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OtpVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {
            if (!empty(Auth::user()->otp) && (Auth::user()->otp_verified == 1)) {
                return $next($request);
            } else if (empty(Auth::user()->otp)) {
                return $next($request);
            } else {
                return redirect('logout');
            }
        }
        return redirect('logout');
    }
}
