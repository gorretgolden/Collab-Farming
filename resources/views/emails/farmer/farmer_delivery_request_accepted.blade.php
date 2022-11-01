@component('mail::message')

Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

@if ($emailInfo['with_edits'])
Your delivery request has been accepted with some adjustments to the schedule. Details are provided below: <br><br>
@else
Your delivery request has been accepted with details below: <br><br>
@endif

<strong>Quantity to deliver:</strong> {{ $emailInfo['quantity'] }} {{ $emailInfo['quantity_type'] }} <br />

@if ($emailInfo['with_edits'])
<strong>Delivery Schedule:</strong> {{ $emailInfo['new_delivery_date'] }} between
{{ $emailInfo['new_delivery_start_time'] }}
and {{ $emailInfo['new_delivery_end_time'] }} (old/previous schedule was 'between
{{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }}') <br>
@else
<strong>Delivery Schedule:</strong> {{ $emailInfo['delivery_date'] }} between
{{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }} <br>
@endif

<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br><br>

Kindly endeovor to deliver the stated quantity with in the agreed time to the designated Bulking Center<br><br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent