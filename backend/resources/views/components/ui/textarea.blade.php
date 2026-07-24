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

    <textarea
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'rows' => $rows,
            'placeholder' => $placeholder,
            'class' => $classes(),
        ]) }}

        @readonly($readonly)
        @disabled($disabled)
    >{{ $value }}</textarea>

    @if ($error)
        <p class="text-sm text-danger">
            {{ $error }}
        </p>
    @elseif ($hint !== '')
        <p class="text-sm text-text-secondary">
            {{ $hint }}
        </p>
    @endif

</div>