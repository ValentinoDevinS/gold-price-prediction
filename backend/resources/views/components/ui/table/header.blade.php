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

            @continue($column->hidden)

            @php
                $isActive = $state->sortColumn === $column->key;

                $direction = $isActive && $state->sortDirection === 'asc'
                    ? 'desc'
                    : 'asc';

                $query = array_merge(
                    request()->query(),
                    [
                        'sort' => $column->key,
                        'direction' => $direction,
                        'page' => 1,
                    ]
                );
            @endphp

            <th class="{{ $style()->headerCell($column) }}">

                @if($column->sortable)

                    <a
                        href="{{ url()->current() . '?' . http_build_query($query) }}"
                        class="inline-flex items-center gap-2 hover:text-indigo-600"
                    >
                        <span>{{ $column->label }}</span>

                        <x-ui.table.sort-indicator
                            :active="$isActive"
                            :direction="$state->sortDirection"
                        />
                    </a>

                @else

                    {{ $column->label }}

                @endif

            </th>

        @endforeach

        {{-- Action Column --}}
        @if(count($actions))

            <th class="{{ $style()->headerCell() }}">
                Action
            </th>

        @endif

    </tr>
</thead>