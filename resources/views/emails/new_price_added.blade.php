@component('mail::message')
<p>Hello {{$name}},</p>

<p>A new quoted price has been posted by Pristine. Details are below.</p>
 <p><span style="font-family: 'Courier New', Courier, monospace;font-size:30px">UGX{{$price}}</span> PER KG</p>
 <p>Login to see historical prices, trends and, or schedule a delivery.</p>

@component('mail::button', ['url' => ''])
LOGIN
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
