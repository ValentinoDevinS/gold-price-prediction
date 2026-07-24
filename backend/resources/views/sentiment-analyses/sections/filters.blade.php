<x-ui.card>

    <form
        method="GET"
        action="{{ route('sentiment-analyses.index') }}"
    >

        <x-ui.grid cols="4">

            {{-- Sentiment --}}
            <div>

                <label
                    for="sentiment_label"
                    class="block text-sm font-medium text-gray-700"
                >
                    Sentiment
                </label>

                <select
                    id="sentiment_label"
                    name="sentiment_label"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

                    <option value="">
                        All
                    </option>

                    @foreach(\App\Enums\SentimentLabel::cases() as $label)

                        <option
                            value="{{ $label->value }}"
                            @selected(request('sentiment_label') == $label->value)
                        >
                            {{ ucfirst(strtolower($label->value)) }}
                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Model --}}
            <div>

                <label
                    for="model_name"
                    class="block text-sm font-medium text-gray-700"
                >
                    Model
                </label>

                <input
                    id="model_name"
                    name="model_name"
                    type="text"
                    value="{{ request('model_name') }}"
                    placeholder="e.g. FinBERT"
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
                        value="analyzed_at"
                        @selected(request('sort', 'analyzed_at') === 'analyzed_at')
                    >
                        Analyzed At
                    </option>

                    <option
                        value="created_at"
                        @selected(request('sort') === 'created_at')
                    >
                        Created
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
                href="{{ route('sentiment-analyses.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

        </div>

    </form>

</x-ui.card>