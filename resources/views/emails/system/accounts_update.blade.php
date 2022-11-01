@component('mail::message')
<h1>FANMIS Weekly Update</h1>

Here's what happened this week on the FANMIS system

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>New Enumerators Added</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['new_enumerators'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Total Enumerators</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['total_enumerators'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Enumerators who collected data</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['enum_collected_data'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Emails sent throught the platform this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['weekly_emails'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>New Egg Producing Farmer this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['new_egg_farmers'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Amount of data profiled this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['data_profiled'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Districts from which data was profiled of data profiled this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['profiled_districts'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Updates deployed to the system this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['updates_deployed'] }}</p>
</div>
</div>

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
<p><strong>Number of Delivery Requests this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['no_delivery_requests'] }}</p>
</div>
</div>


<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Number of Input Requests this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['no_input_requests'] }}</p>
</div>
</div>

<br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
