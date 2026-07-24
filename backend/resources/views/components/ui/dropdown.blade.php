@foreach($items as $item)

    <button
        type="button"
        class="{{ $style()->item() }}"
    >

        <span class="{{ $style()->checkmark() }}">

            @if($item->checked)

                ✓

            @endif

        </span>

        @if($item->icon)

            <span>{{ $item->icon }}</span>

        @endif

        <span>

            {{ $item->label }}

        </span>

    </button>

@endforeach