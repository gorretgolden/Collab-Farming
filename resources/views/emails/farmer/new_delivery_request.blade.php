@component('mail::message')
<h2>Hello {{ $emailInfo['receiver_name'] }}</h2>

A new delivery request has been submitted with details below:<br><br>

<strong>Requesting Farmer:</strong> {{ $emailInfo['farmer_name'] }} <br>
@if ($emailInfo['quantity'])
<strong>Quantity to deliver:</strong> {{ $emailInfo['quantity'] }} {{ $emailInfo['quantity_type'] }} <br />
@endif

@if (count($emailInfo['farm_supplies']) > 0)
@foreach ($emailInfo['farm_supplies'] as $farm)
@if ($farm->requestQuantity && $farm->requestTypeText)
<strong>Request for:</strong> {{ $farm->requestQuantity }} {{ $farm->requestTypeText }} <br>
@endif
@endforeach
@endif

<strong>Delivery Schedule:</strong> {{ $emailInfo['delivery_date'] }} between {{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }} <br>
<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br><br>

Click the button below to review/action the schedule <br>

@component('mail::button', ['url' => url('/account-dashboard')])
REVIEW REQUEST
@endcomponent


Regards,<br>
{{ config('app.name') }} Team
@endcomponent
