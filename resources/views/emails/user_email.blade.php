@component('mail::message')
Hello {{$user->name}},

{!! $user->email_message !!}

Thanks, <br>
{{config('app.name')}}
@endcomponent