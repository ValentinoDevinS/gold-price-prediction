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

    <div class="relative">

        <select
            {{ $attributes->merge([
                'id' => $id,
                'name' => $name,
                'class' => $style->select(),
            ]) }}

            @disabled($disabled)
            @required($required)
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

        <div class="{{ $style->icon() }}">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </div>

    </div>

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