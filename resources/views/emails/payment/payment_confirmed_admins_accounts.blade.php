@component('mail::message')

Hello <strong>{{ $emailInfo['receiver_name'] }}</strong>, <br><br>

{{ $emailInfo['farmer_name'] }} has confirmed receipt of the following payment:<br><br>

<strong>Quantity delivered:</strong> {{ $emailInfo['quantity'] }} Trays <br />
<strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} on {{ $emailInfo['delivery_date'] }} <br>
<strong>Average Weight Per Tray:</strong> {{ $emailInfo['average_weight'] }} KGs<br>
<strong>Price/KG:</strong> UGX {{ $emailInfo['average_price'] }}<br>
<strong>Payment:</strong> UGX {{ $emailInfo['amount'] }} <br>

No further action is required on your part.


Regards,<br>
{{ config('app.name') }} Team
@endcomponent
