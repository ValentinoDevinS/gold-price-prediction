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

    <select
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'class' => $classes(),
        ]) }}

        @disabled($disabled)
    >

        @if ($placeholderOption !== '')
            <option
                value=""
                @selected($value === null || $value === '')
            >
                {{ $placeholderOption }}
            </option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)

            <option
                value="{{ $optionValue }}"
                @selected($isSelected($optionValue))
            >
                {{ $optionLabel }}
            </option>

        @endforeach

    </select>

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