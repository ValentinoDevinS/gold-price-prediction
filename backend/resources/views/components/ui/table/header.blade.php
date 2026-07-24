<thead class="{{ $style()->header() }}">
    <tr>

        {{-- Bulk Selection --}}
        @if(count($actions))
            <th class="{{ $style()->headerCell() }}" style="width: 50px;">
                <input type="checkbox">
            </th>
        @endif

        {{-- Columns --}}
        @foreach($columns as $column)

            @if(! $column->hidden)

                <th class="{{ $style()->headerCell($column) }}">
                    @if($column->sortable)

                        <button
                            type="button"
                            class="flex items-center gap-2"
                        >
                            <span>{{ $column->label }}</span>

                            <x-ui.table.sort-indicator
                                :active="$state->sortColumn === $column->key"
                                :direction="$state->sortDirection"
                            />

                        </button>

                    @else

                        {{ $column->label }}

                    @endif
                </th>

            @endif

        @endforeach

        {{-- Action Column --}}
        @if(count($actions))

            <th class="{{ $style()->headerCell() }}">
                Action
            </th>

        @endif

    </tr>
</thead>