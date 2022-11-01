@component('mail::message')
Hello <strong>{{ $emailInfo['farmer_name'] }}</strong>, <br><br>

A delivery has been weighed. Details are provided below:
<br><br>


<p><strong>Quantity to deliver:</strong> {{ $emailInfo['quantity_to_deliver'] }} {{ $emailInfo['quantity_type'] }} <br /></p>
<p><strong>Actual Quantity Delivered:</strong> {{ $emailInfo['actual_no_of_trays'] }} {{ $emailInfo['quantity_type'] }} <br /></p>
<p><strong>Bulking Center:</strong> {{ $emailInfo['bulking_center'] }} <br></p>
<p><strong>Average Weight Per Tray:</strong> {{$emailInfo['average_weight']}} KGs<br></p>
<p><strong>Current Price/KG:</strong> UGX {{$emailInfo['current_price']}}<br></p>
<p><strong>Payout Expected:</strong> UGX {{$emailInfo['total_price']}}<br></p>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
