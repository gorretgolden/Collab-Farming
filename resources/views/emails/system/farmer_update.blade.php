@component('mail::message')
<h1>FANMIS Weekly Farmer Update</h1>

Here's what happened this week on the FANMIS system

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Average Price for Eggs this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>UGX {{ $emailInfo['avg_egg_price'] }} per KG</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Delivery Requests you made this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['no_delivery_requests'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Input Requests you made this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['no_input_requests'] }}</p>
</div>
</div>

<br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
