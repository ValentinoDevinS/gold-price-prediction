@props([
    'status',
])

@php

$map = [

    'NEW' => [
        'variant' => 'blue',
        'label' => 'New',
    ],

    'DOWNLOADED' => [
        'variant' => 'green',
        'label' => 'Downloaded',
    ],

    'CLEANED' => [
        'variant' => 'purple',
        'label' => 'Cleaned',
    ],

    'FAILED' => [
        'variant' => 'red',
        'label' => 'Failed',
    ],

];

$config = $map[$status] ?? [

    'variant' => 'gray',

    'label' => $status,

];

@endphp

<x-ui.badge :variant="$config['variant']">

    {{ $config['label'] }}

</x-ui.badge>