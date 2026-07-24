<x-ui.card>

    <x-ui.section-header
        title="Filters"
        description="Filter and sort prediction evaluations."
    />

    <form
        method="GET"
        action="{{ route('prediction-evaluations.index') }}"
    >

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

            <x-ui.input
                type="date"
                name="actual_price_date"
                label="Actual Price Date"
                :value="request('actual_price_date')"
            />

            <x-ui.select
                name="sort"
                label="Sort By"
            >
                <option value="">Latest</option>

                <option
                    value="actual_price_date"
                    @selected(request('sort') === 'actual_price_date')
                >
                    Actual Price Date
                </option>

                <option
                    value="evaluated_at"
                    @selected(request('sort') === 'evaluated_at')
                >
                    Evaluated At
                </option>

                <option
                    value="created_at"
                    @selected(request('sort') === 'created_at')
                >
                    Created At
                </option>

            </x-ui.select>

            <x-ui.select
                name="direction"
                label="Direction"
            >

                <option
                    value="desc"
                    @selected(request('direction') === 'desc')
                >
                    Descending
                </option>

                <option
                    value="asc"
                    @selected(request('direction') === 'asc')
                >
                    Ascending
                </option>

            </x-ui.select>

            <x-ui.select
                name="per_page"
                label="Per Page"
            >

                @foreach([10,20,50,100] as $size)

                    <option
                        value="{{ $size }}"
                        @selected(request('per_page',20)==$size)
                    >
                        {{ $size }}
                    </option>

                @endforeach

            </x-ui.select>

            <div class="flex items-end gap-2">

                <x-ui.button type="submit">

                    Apply

                </x-ui.button>

                <a
                    href="{{ route('prediction-evaluations.index') }}"
                    class="btn btn-secondary"
                >
                    Reset
                </a>

            </div>

        </div>

    </form>

</x-ui.card>