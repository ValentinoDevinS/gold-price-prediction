@php
    $style = $style();
@endphp

<div class="{{ $style->wrapper() }}">

    @if ($label !== '')
        <label
            for="{{ $id }}"
            class="{{ $style->label() }}"
        >
            {{ $label }}

            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'class' => $style->textarea(),
        ]) }}

        @readonly($readonly)
        @disabled($disabled)
        @required($required)
    >{{ $value }}</textarea>

    @if ($errorMessage())
        <p class="{{ $style->error() }}">
            {{ $errorMessage() }}
        </p>
    @elseif ($hint !== '')
        <p class="{{ $style->helper() }}">
            {{ $hint }}
        </p>
    @endif

</div>