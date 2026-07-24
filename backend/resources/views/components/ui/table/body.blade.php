<tbody>

    @forelse($rows as $row)

        <tr class="{{ $style()->row() }}">

            {{-- Bulk Selection --}}
            @if(!empty($actions))
                <td class="{{ $style()->cell() }}">
                    <input
                        type="checkbox"
                        name="selected[]"
                        value="{{ $row->id }}"
                    >
                </td>
            @endif

            {{-- Data Columns --}}
            @foreach($columns as $column)

                @continue($column->hidden)

                <td
                    class="{{ $style()->cell($column->alignment) }}"
                >

                    {{ data_get($row, $column->key) }}

                </td>

            @endforeach

            {{-- Row Actions --}}
            @if(!empty($actions))

                <td class="{{ $style()->cell() }}">

                    <div class="flex items-center gap-2 justify-end">

                        @foreach($actions as $action)

                            @continue($action->bulk)

                            <x-ui.button
                                size="sm"
                                variant="ghost"
                            >
                                {{ $action->label }}
                            </x-ui.button>

                        @endforeach

                    </div>

                </td>

            @endif

        </tr>

    @empty

        @include('components.ui.table.empty-state')

    @endforelse

</tbody>