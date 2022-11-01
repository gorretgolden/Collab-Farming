@component('mail::message')

Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

A payment of <strong>UGX {{ $emailInfo['amount'] }}</strong> has been effected to you with details below:<br><br>

<strong>Quantity delivered:</strong> {{ $emailInfo['quantity'] }} Trays, Avg weight per Tray: {{ $emailInfo['average_weight'] }} KGs <br />
<strong>Delivery Date:</strong> {{ $emailInfo['delivery_date'] }} <br>
<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br>
<strong>Weighed by:</strong> {{ $emailInfo['weighed_by'] }} <br><br>

Kindly confirm the receipt of this payment as soon as the funds reflect on your side.<br>

@component('mail::button', ['url' =>url('/account-dashboard')])
CONFIRM RECEIPT
@endcomponent


Regards,<br>
{{ config('app.name') }} Team
@endcomponent
