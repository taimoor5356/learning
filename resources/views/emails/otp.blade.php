@component('mail::message')
Hello {{$user->name}},

<p>Your OTP </p>

<h3>{{$user->otp}}</h3>

<p>In case you have any issues, please contact us</p>

Thanks, <br>
{{config('app.name')}}
@endcomponent