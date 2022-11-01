@component('mail::message')
<b>Hello {{ $details->name }},</b>

An account has been created for you on <b>FANMIS</b>

You may now login with the below credentials below:

Email: <b>{{ $details->email }}</b><br />
Password:<b> {{$details->password }}</b><br />

@component('mail::button', ['url' =>url('/login')])
CLICK HERE TO LOGIN
@endcomponent

Regards,<br>
{{ config('app.name') }} Team
@endcomponent