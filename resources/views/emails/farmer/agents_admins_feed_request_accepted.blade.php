@component('mail::message')
Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

@if ($emailInfo['with_edits'])
The feed request below has been accepted with some adjustments to the schedule. Details are provided below:
    <br><br>
@else
The feed request below has been accepted with details below: <br><br>
@endif

<strong>Requesting Farmer:</strong> {{ $emailInfo['farmer_name'] }} <br />
@if (count($emailInfo['farm_supplies']) > 0)
<strong>Request for:</strong>
@foreach ($emailInfo['farm_supplies'] as $farm)
 {{ $farm->product_quantity }} {{ $farm->product->inputs }},
@endforeach
@endif

<strong>Delivery Schedule:</strong> {{ $emailInfo['delivery_date'] }} between
{{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }} <br>

<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br><br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
