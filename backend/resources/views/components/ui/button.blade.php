@php
    $style = $style();
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class($style->wrapper()) }}
    @disabled($isDisabled())
    @if($loading)
        aria-busy="true"
    @endif
>

    @if($loading)

        <span
            class="{{ $style->loadingIcon() }}"
            aria-hidden="true">
        </span>

        <span class="{{ $style->label() }}">
            {{ $loadingLabel() }}
        </span>

    @else

        <span class="{{ $style->label() }}">
            {{ $slot }}
        </span>

    @endif

</button>