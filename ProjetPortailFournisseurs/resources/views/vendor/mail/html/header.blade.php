@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{url('/images/Logo.png')}}" class="logo" alt="V3R Logo">
<br>
{{ $slot }}
@endif
</a>
</td>
</tr>
