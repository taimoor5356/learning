@component('mail::message')

<p>Your Password </p>

<h3>{{$pass}}</h3>

<p>You can update your password from your account or click Forgot Password from Login screen. In case you have any issues, please contact us</p>

Thanks, <br>
{{config('app.name')}}
@endcomponent