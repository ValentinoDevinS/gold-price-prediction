<div {{ $attributes->merge([
    'class' => $style()->container($variant),
]) }}>

    {{ $slot }}

</div>