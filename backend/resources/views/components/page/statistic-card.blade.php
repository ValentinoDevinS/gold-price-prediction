@php
    $style = $style();
@endphp

<div {{ $attributes->class($style->wrapper()) }}>

    <div class="flex items-start justify-between">

        <div>

            <p class="{{ $style->label() }}">
                {{ $label }}
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

        @if($icon)

            <div class="{{ $style->iconWrapper() }}">

                {!! $icon !!}

            </div>

        @endif

    </div>

</div>