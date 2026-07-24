<div class="space-y-1">

    <div class="flex items-start gap-3">

        <input
            {{ $attributes->merge([
                'id' => $id,
                'type' => 'checkbox',
                'name' => $name,
                'value' => $value,
                'class' => $classes(),
            ]) }}

            @checked($checked)
            @disabled($disabled)
            @required($required)
        >

        <div class="flex-1">

            @if ($label !== '')
                <label
                    for="{{ $id }}"
                    class="block text-sm font-medium text-text cursor-pointer"
                >
                    {{ $label }}

                    @if ($required)
                        <span class="text-danger">*</span>
                    @endif
                </label>
            @endif

            @if ($error)
                <p class="mt-1 text-sm text-danger">
                    {{ $error }}
                </p>
            @elseif ($hint !== '')
                <p class="mt-1 text-sm text-text-secondary">
                    {{ $hint }}
                </p>
            @endif

        </div>

    </div>

</div>