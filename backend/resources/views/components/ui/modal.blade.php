<div
    x-data="{ open: false }"
    x-show="open"
    x-cloak
    class="{{ $style()->overlay() }}"
>

    <div class="{{ $style()->container() }}">

        <div class="{{ $style()->header() }}">

            <h2 class="{{ $style()->title() }}">

                {{ $title }}

            </h2>

            <button
                type="button"
                x-on:click="open = false"
            >
                ✕

            </button>

        </div>

        <div class="{{ $style()->body() }}">

            {{ $slot }}

        </div>

        @isset($footer)

            <div class="{{ $style()->footer() }}">

                {{ $footer }}

            </div>

        @endisset

    </div>

</div>