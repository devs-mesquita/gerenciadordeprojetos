@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://contratos.mesquita.rj.gov.br/img/brasaoo.png" class="logo" alt="Mesquita Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
