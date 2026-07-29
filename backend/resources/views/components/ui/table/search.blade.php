<form method="GET" class="flex items-center">

    {{-- Preserve existing query parameters --}}
    @foreach(request()->except(['search', 'page']) as $key => $value)

        @if(is_array($value))
            @foreach($value as $item)
                <input
                    type="hidden"
                    name="{{ $key }}[]"
                    value="{{ $item }}"
                >
            @endforeach
        @else
            <input
                type="hidden"
                name="{{ $key }}"
                value="{{ $value }}"
            >
        @endif

    @endforeach

    <input
        type="search"
        name="search"
        value="{{ $value }}"
        placeholder="Search..."
        class="w-64 rounded-lg border border-gray-300 px-3 py-2 text-sm
               focus:border-indigo-500 focus:outline-none focus:ring-2
               focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800
               dark:text-white"
    >

</form>