<x-ui.card>

    <x-slot:header>
        <div>
            <h2 class="text-lg font-semibold text-text">
                Pipeline Status
            </h2>

            <p class="mt-1 text-sm text-text-secondary">
                Current status of the data processing pipeline.
            </p>
        </div>
    </x-slot:header>

    @php
        $steps = [
            ['name' => 'News Scraper', 'status' => 'Waiting'],
            ['name' => 'Article Downloader', 'status' => 'Waiting'],
            ['name' => 'Article Cleaner', 'status' => 'Waiting'],
            ['name' => 'FinBERT Sentiment', 'status' => 'Waiting'],
            ['name' => 'Feature Engineering', 'status' => 'Waiting'],
            ['name' => 'LSTM Model', 'status' => 'Waiting'],
            ['name' => 'CNN Model', 'status' => 'Waiting'],
            ['name' => 'ANN Model', 'status' => 'Waiting'],
            ['name' => 'Prediction', 'status' => 'Waiting'],
        ];
    @endphp

    <div class="divide-y divide-border">

        @foreach ($steps as $step)

            <div class="flex items-center justify-between py-4">

                <div>
                    <p class="font-medium text-text">
                        {{ $step['name'] }}
                    </p>

                    <p class="text-sm text-text-secondary">
                        Pipeline stage
                    </p>
                </div>

                <span
                    class="rounded-full border border-border bg-surface-secondary px-3 py-1 text-sm font-medium text-text-secondary"
                >
                    {{ $step['status'] }}
                </span>

            </div>

        @endforeach

    </div>

</x-ui.card>