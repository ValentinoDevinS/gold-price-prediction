<div class="space-y-1">

    @if ($label !== '')
        <label
            for="{{ $id }}"
            class="block text-sm font-medium text-text"
        >
            {{ $label }}

            @if ($required)
                <span class="text-danger">*</span>
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
            'class' => $classes(),
        ]) }}

        @required($required)
        @readonly($readonly)
        @disabled($disabled)
    >

    @if ($errorMessage())
        <p class="text-sm text-danger">
            {{ $errorMessage() }}
        </p>
    @elseif ($hint !== '')
        <p class="text-sm text-text-secondary">
            {{ $hint }}
        </p>
    @endif

</div>