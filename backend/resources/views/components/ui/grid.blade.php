@props([
    'cols' => '1',
])

<div
{{ $attributes->merge([
'class'=>"grid gap-4 md:grid-cols-$cols"
]) }}
>

{{ $slot }}

</div>