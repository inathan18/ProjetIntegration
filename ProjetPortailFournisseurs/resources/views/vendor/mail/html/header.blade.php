@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img img src="{{url('images/logo.png')}}" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
