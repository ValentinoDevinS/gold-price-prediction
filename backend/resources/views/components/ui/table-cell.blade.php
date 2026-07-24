@props([
'header'=>false,
])

@if($header)

<th
{{ $attributes->merge([
'class'=>'px-4 py-3 text-left text-sm font-semibold text-gray-700'
]) }}
>

{{ $slot }}

</th>

@else

<td
{{ $attributes->merge([
'class'=>'px-4 py-4 text-sm text-gray-700'
]) }}
>

{{ $slot }}

</td>

@endif