@php
    $style = $style();
@endphp

<div {{ $attributes->class($style->wrapper()) }}>

    <div class="flex items-start justify-between">

        <div class="flex-1">

            <p class="{{ $style->title() }}">
                {{ $title }}
            </p>

            <h3 class="{{ $style->value() }}">
                {{ $value }}
            </h3>

            @if($description)

                <p class="{{ $style->description() }}">
                    {{ $description }}
                </p>

            @endif

        </div>

        @isset($icon)

            <div class="{{ $style->icon() }}">

                {{ $icon }}

            </div>

        @endisset

    </div>

</div>