<x-ui.card>

    <x-ui.section-header
        title="Filters"
        description="Filter and search ensemble prediction results."
    />

    <form
        method="GET"
        action="{{ route('ensemble-results.index') }}"
        class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6"
    >

        <x-ui.input
            name="search"
            label="Search"
            placeholder="Method or Version..."
            :value="request('search')"
        />

        <x-ui.select
            name="ensemble_method"
            label="Ensemble Method"
            :options="[
                '' => 'All Methods',
                'AVERAGE' => 'Average',
                'WEIGHTED_AVERAGE' => 'Weighted Average',
                'MEDIAN' => 'Median',
                'STACKING' => 'Stacking',
            ]"
            :selected="request('ensemble_method')"
        />

        <x-ui.input
            type="date"
            name="prediction_date"
            label="Prediction Date"
            :value="request('prediction_date')"
        />

        <x-ui.select
            name="sort"
            label="Sort By"
            :options="[
                'prediction_date' => 'Prediction Date',
                'predicted_at' => 'Predicted At',
                'created_at' => 'Created At',
            ]"
            :selected="request('sort', 'prediction_date')"
        />

        <x-ui.select
            name="direction"
            label="Direction"
            :options="[
                'desc' => 'Descending',
                'asc' => 'Ascending',
            ]"
            :selected="request('direction', 'desc')"
        />

        <x-ui.select
            name="per_page"
            label="Per Page"
            :options="[
                10 => '10',
                20 => '20',
                50 => '50',
                100 => '100',
            ]"
            :selected="request('per_page', 20)"
        />

        <div class="xl:col-span-4 flex justify-end gap-2">

            <a
                href="{{ route('ensemble-results.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Apply Filters
            </button>

        </div>

    </form>

</x-ui.card>