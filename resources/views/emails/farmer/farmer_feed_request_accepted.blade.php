@component('mail::message')

Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

@if ($emailInfo['with_edits'])
Your feed request has been accepted with some adjustments to the schedule. Details are provided below: <br><br>
@else
Your feed request has been accepted with details below: <br><br>
@endif

@if (count($emailInfo['farm_supplies']) > 0)
<strong>Request for:</strong>
@foreach ($emailInfo['farm_supplies'] as $farm)
 {{ $farm->product_quantity }} {{ $farm->product->inputs }},
@endforeach
@endif
{{-- <strong>Request for:</strong> {{ $emailInfo['quantity'] }} {{ $emailInfo['quantity_type'] }} <br /> --}}


<strong>Delivery Schedule:</strong> {{ $emailInfo['delivery_date'] }} between
{{ $emailInfo['delivery_start_time'] }}
and {{ $emailInfo['delivery_end_time'] }} <br>

<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br><br>

{{-- Kindly endeovor to deliver the stated quantity with in the agreed time to the designated Bulking Center<br><br> --}}

Regards,<br>
{{ config('app.name') }} Team
@endcomponent