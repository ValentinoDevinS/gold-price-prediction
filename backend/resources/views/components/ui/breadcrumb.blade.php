<nav
    aria-label="Breadcrumb"
    class="{{ $style()->container() }}"
>
    @foreach($items as $item)

        @if (! $loop->first)

            <span class="{{ $style()->separator() }}">
                /
            </span>

        @endif

        @if($item->isCurrent())

            <span class="{{ $style()->current() }}">
                {{ $item->label }}
            </span>

        @else

            <a
                href="{{ $item->url }}"
                class="{{ $style()->link() }}"
            >
                {{ $item->label }}
            </a>

        @endif

    @endforeach
</nav>