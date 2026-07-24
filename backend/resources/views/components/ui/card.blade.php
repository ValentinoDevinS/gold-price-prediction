<div
    {{ $attributes->class($classes()) }}
    data-debug="{{ $classes() }}"
>

    @isset($header)
        <div class="border-b border-border px-6 py-4">
            {{ $header }}
        </div>
    @endisset

    <div class="{{ $bodyClasses() }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-border px-6 py-4">
            {{ $footer }}
        </div>
    @endisset

</div>