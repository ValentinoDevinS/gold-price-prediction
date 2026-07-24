<div class="{{ $style()->toolbar() }}">

    <div class="flex items-center gap-3">

        {{-- Search --}}
        @if(collect($columns)->contains(fn($column) => $column->searchable))

            <x-ui.table.search
                :value="$state->search"
            />

        @endif

        {{-- Filters --}}
        @foreach($filters as $filter)

            <x-ui.select
                :name="$filter->key"
                :options="$filter->options"
                :value="$filter->value"
                size="sm"
            />

        @endforeach

    </div>

    <div class="flex items-center gap-2">

        <x-ui.table.export />

    </div>

</div>