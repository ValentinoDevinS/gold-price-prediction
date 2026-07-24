@props([
    'space' => '6',
])

<div
    {{ $attributes->merge([
        'class' => 'space-y-' . $space,
    ]) }}
>

    {{ $slot }}

</div>