@component('mail::message')

<h2>Hello {{ $emailInfo['receiver_name'] }}</h2>

Your delivery request has been submitted with details below <br><br>


@if ($emailInfo['quantity'])
<strong>Quantity to deliver:</strong> {{ $emailInfo['quantity'] }} {{ $emailInfo['quantity_type'] }} <br />
@endif

@if (count($emailInfo['farm_supplies']) > 0)
@foreach ($emailInfo['farm_supplies'] as $farm)
<strong>Request for:</strong> {{ $farm->requestQuantity }} {{ $farm->requestType }} <br>
@endforeach
@endif

<strong>Delivery Schedule:</strong> {{ $emailInfo['delivery_date'] }} between {{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }} <br>
<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br><br>

This proposed schedule has been share with Pristine.
You will receive updates on the status of your proposed delivery schedule. <br><br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
