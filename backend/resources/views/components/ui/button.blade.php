<button
    type="{{ $type }}"
    {{ $attributes->class($classes()) }}
    @disabled($isDisabled())
    @if($loading)
        aria-busy="true"
    @endif
>

    @if($loading)

        <span
            class="inline-block h-4 w-4 mr-2 animate-spin rounded-full border-2 border-current border-t-transparent"
            aria-hidden="true">
        </span>

        {{ $loadingLabel() }}

    @else

        {{ $slot }}

    @endif

</button>