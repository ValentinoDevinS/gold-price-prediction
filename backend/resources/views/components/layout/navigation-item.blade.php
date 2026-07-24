<a
    href="{{ route($item->route) }}"
    class="{{ $style()->link($active()) }}"
>

    @if($item->icon)

        <span class="{{ $style()->icon() }}">

            {!! $item->icon !!}

        </span>

    @endif

    <span class="{{ $style()->label() }}">

        {{ $item->label }}

    </span>

</a>