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

    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => $type,
            'name' => $name,
            'value' => $value,
            'placeholder' => $placeholder,
            'class' => $style->input(),
        ]) }}

        @required($required)
        @readonly($readonly)
        @disabled($disabled)
    >

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