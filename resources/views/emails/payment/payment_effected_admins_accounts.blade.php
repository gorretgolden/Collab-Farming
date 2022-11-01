@component('mail::message')

Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

A payment of <strong>UGX {{ $emailInfo['amount'] }}</strong> has been effected to {{ $emailInfo['farmer_name'] }} with details below:<br><br>

<strong>Quantity delivered:</strong> {{ $emailInfo['quantity'] }} Trays, Avg weight per Tray: {{ $emailInfo['average_weight'] }} KGs <br />
<strong>Delivery Date:</strong> {{ $emailInfo['delivery_date'] }} <br>
<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br>
<strong>Weighed by:</strong> {{ $emailInfo['weighed_by'] }} <br><br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
