<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === \App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value))
<img src="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
