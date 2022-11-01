@component('mail::message')
<p>Hello {{$delivery->farmer->name}},</p>
@foreach ($delivery->farm_requests as $item)
<p>Your delivery of {{$item->request_quantity}} {{$item->request_input}} has been completed. Click the button below to confirm receipt of the delivery.
@endforeach
</p>

@component('mail::button', ['url' => ''])
CONFIRM RECEIPT
@endcomponent

Regards,<br>
{{ config('app.name') }} Team
@endcomponent

