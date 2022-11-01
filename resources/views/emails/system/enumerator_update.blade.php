@component('mail::message')
<h1>FANMIS Weekly Enumerator Update</h1>

Here's what happened this week on the FANMIS system

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Total Data Collected this week</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['data_profiled'] }}</p>
</div>
</div>

<div style="display: flex; border-left: 1px solid #d1d5db; border-top: 1px solid #d1d5db; border-right: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db;">
<div style="flex: 1; background-color:#f5f6fa; padding:15px 0px 0px 20px; border-right: 1px solid #d1d5db;">
<p><strong>Districts from which data was obtained</strong></p>
</div>

<div style="flex: 2; padding:15px 0px 0px 20px;">
<p>{{ $emailInfo['profiled_districts'] }}</p>
</div>
</div>

<br>

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
