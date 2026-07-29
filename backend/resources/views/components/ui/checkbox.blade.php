@php
    $style = $style();
@endphp

<div class="{{ $style->wrapper() }}">

    <input
        {{ $attributes->merge([
            'id' => $id,
            'type' => 'checkbox',
            'name' => $name,
            'value' => $value,
            'class' => $style->checkbox(),
        ]) }}

        @checked($checked)
        @disabled($disabled)
        @required($required)
    >

    <div class="flex-1">

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

</div>