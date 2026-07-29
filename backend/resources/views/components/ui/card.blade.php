@php
    $style = $style();
@endphp

<div {{ $attributes->class($style->wrapper()) }}>

    @isset($header)
        <div class="{{ $style->header() }}">
            {{ $header }}
        </div>
    @endisset

    <div {{ $attributes->only('id')->class([
        $style->body(),
        $bodyPadding(),
    ]) }}>
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="{{ $style->footer() }}">
            {{ $footer }}
        </div>
    @endisset

</div>