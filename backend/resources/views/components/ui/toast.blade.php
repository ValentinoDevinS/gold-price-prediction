<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    {{ $attributes->merge([
        'class' => $style()->container($variant),
    ]) }}
>

    <div class="flex-1">

        {{ $slot }}

    </div>

    <button
        type="button"
        x-on:click="show = false"
        class="font-bold"
    >
        ×
    </button>

</div>