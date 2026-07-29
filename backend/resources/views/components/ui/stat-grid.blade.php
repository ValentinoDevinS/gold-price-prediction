@php
    $style = $style();
@endphp

<div {{ $attributes->class(
    $style->wrapper($columns)
) }}>

    {{ $slot }}

</div>