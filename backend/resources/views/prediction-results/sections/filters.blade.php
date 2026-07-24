<x-ui.card>

    <form
        method="GET"
        action="{{ route('prediction-results.index') }}"
    >

        <x-ui.grid cols="4">

            {{-- Model --}}
            <div>

                <label
                    for="model_name"
                    class="block text-sm font-medium text-gray-700"
                >
                    Model
                </label>

                <select
                    id="model_name"
                    name="model_name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

                    <option value="">
                        All Models
                    </option>

                    <option
                        value="LSTM"
                        @selected(request('model_name') === 'LSTM')
                    >
                        LSTM
                    </option>

                    <option
                        value="CNN"
                        @selected(request('model_name') === 'CNN')
                    >
                        CNN
                    </option>

                    <option
                        value="ANN"
                        @selected(request('model_name') === 'ANN')
                    >
                        ANN
                    </option>

                    <option
                        value="ENSEMBLE"
                        @selected(request('model_name') === 'ENSEMBLE')
                    >
                        ENSEMBLE
                    </option>

                </select>

            </div>

            {{-- Model Version --}}
            <div>

                <label
                    for="model_version"
                    class="block text-sm font-medium text-gray-700"
                >
                    Model Version
                </label>

                <input
                    id="model_version"
                    name="model_version"
                    type="text"
                    value="{{ request('model_version') }}"
                    placeholder="latest / final"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

            </div>

            {{-- Prediction Date --}}
            <div>

                <label
                    for="prediction_date"
                    class="block text-sm font-medium text-gray-700"
                >
                    Prediction Date
                </label>

                <input
                    id="prediction_date"
                    name="prediction_date"
                    type="date"
                    value="{{ request('prediction_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >

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

        <x-ui.grid
            cols="2"
            class="mt-6"
        >

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
                        value="prediction_date"
                        @selected(request('sort','prediction_date') === 'prediction_date')
                    >
                        Prediction Date
                    </option>

                    <option
                        value="predicted_at"
                        @selected(request('sort') === 'predicted_at')
                    >
                        Predicted At
                    </option>

                    <option
                        value="created_at"
                        @selected(request('sort') === 'created_at')
                    >
                        Created At
                    </option>

                    <option
                        value="updated_at"
                        @selected(request('sort') === 'updated_at')
                    >
                        Updated At
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
                        @selected(request('direction','desc') === 'desc')
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

        </x-ui.grid>

        <div class="mt-6 flex items-center gap-3">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Apply Filters
            </button>

            <a
                href="{{ route('prediction-results.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

        </div>

    </form>

</x-ui.card>