<x-ui.card>

    <form
        method="GET"
        action="{{ route('clean-articles.index') }}"
    >

        <x-ui.grid cols="4">

            {{-- Search --}}
            <div>

                <label
                    for="search"
                    class="block text-sm font-medium text-gray-700"
                >
                    Search
                </label>

                <input
                    id="search"
                    name="search"
                    type="text"
                    value="{{ request('search') }}"
                    placeholder="Search clean content..."
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
                        value="cleaned_at"
                        @selected(request('sort', 'cleaned_at') === 'cleaned_at')
                    >
                        Cleaned At
                    </option>

                    <option
                        value="created_at"
                        @selected(request('sort') === 'created_at')
                    >
                        Created
                    </option>

                </select>

            </div>

            {{-- Direction --}}
            <div>

                <label
                    for="direction"
                    class="block text-sm font-medium text-gray-700"
                >
                    Direction
                </label>

                <select
                    id="direction"
                    name="direction"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

                    <option
                        value="desc"
                        @selected(request('direction', 'desc') === 'desc')
                    >
                        Descending
                    </option>

                    <option
                        value="asc"
                        @selected(request('direction') === 'asc')
                    >
                        Ascending
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
                href="{{ route('clean-articles.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

        </div>

    </form>

</x-ui.card>