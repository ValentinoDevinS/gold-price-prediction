@if($active)

    @if($direction === \App\Enums\Ui\SortDirection::Asc)

        ▲

    @else

        ▼

    @endif

@else

    <span class="opacity-30">

        ⇅

    </span>

@endif