<x-ui.card>

    <form
        method="GET"
        action="{{ route('feature-snapshots.index') }}"
    >

        <x-ui.grid cols="4">

            {{-- Feature Version --}}
            <div>

                <label
                    for="feature_version"
                    class="block text-sm font-medium text-gray-700"
                >
                    Feature Version
                </label>

                <input
                    id="feature_version"
                    name="feature_version"
                    type="text"
                    value="{{ request('feature_version') }}"
                    placeholder="e.g. v1.0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

            </div>

            {{-- Snapshot Date --}}
            <div>

                <label
                    for="snapshot_date"
                    class="block text-sm font-medium text-gray-700"
                >
                    Snapshot Date
                </label>

                <input
                    id="snapshot_date"
                    name="snapshot_date"
                    type="date"
                    value="{{ request('snapshot_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

            </div>

            {{-- Sort --}}
            <div>

                <label
                    for="sort"
                    class="block text-sm font-medium text-gray-700"
                >
                    Sort By
                </label>

                <select
                    id="sort"
                    name="sort"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

                    <option
                        value="snapshot_date"
                        @selected(request('sort', 'snapshot_date') === 'snapshot_date')
                    >
                        Snapshot Date
                    </option>

                    <option
                        value="generated_at"
                        @selected(request('sort') === 'generated_at')
                    >
                        Generated At
                    </option>

                    <option
                        value="created_at"
                        @selected(request('sort') === 'created_at')
                    >
                        Created At
                    </option>

                </select>

            </div>

            {{-- Per Page --}}
            <div>

                <label
                    for="per_page"
                    class="block text-sm font-medium text-gray-700"
                >
                    Per Page
                </label>

                <select
                    id="per_page"
                    name="per_page"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

                    @foreach([10,20,50,100] as $size)

                        <option
                            value="{{ $size }}"
                            @selected(request('per_page',20) == $size)
                        >
                            {{ $size }}
                        </option>

                    @endforeach

                </select>

            </div>

        </x-ui.grid>

        <div class="mt-6 flex items-center gap-3">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Apply Filters
            </button>

            <a
                href="{{ route('feature-snapshots.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

        </div>

    </form>

</x-ui.card>