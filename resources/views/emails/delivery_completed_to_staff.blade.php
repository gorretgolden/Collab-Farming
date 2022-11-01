@component('mail::message')
<p> Hello {{$staff}}, </p>
@foreach ($delivery->farm_requests as $item)
<p> The {{$item->request_quantity}} {{$item->request_input}} to {{$delivery->farmer->name}} has been completed.</p>
@endforeach

Regards,<br>
{{ config('app.name') }} Team
@endcomponent

