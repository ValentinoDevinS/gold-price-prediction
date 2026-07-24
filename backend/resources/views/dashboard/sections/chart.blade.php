<x-ui.card>

    <x-slot:header>
        <div>
            <h2 class="text-lg font-semibold text-text">
                Gold Price Trend
            </h2>

            <p class="mt-1 text-sm text-text-secondary">
                Daily gold price movement and prediction trend.
            </p>
        </div>
    </x-slot:header>

    <div
        class="flex h-96 items-center justify-center rounded-lg border border-dashed border-border bg-surface-secondary"
    >
        <div class="text-center">

            <svg
                class="mx-auto h-12 w-12 text-text-secondary"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 3v18h18M7 15l3-3 3 2 4-6"
                />
            </svg>

            <h3 class="mt-4 text-lg font-medium text-text">
                Gold Price Chart
            </h3>

            <p class="mt-2 text-sm text-text-secondary">
                Chart integration will be available after historical
                gold price data has been imported.
            </p>

        </div>
    </div>

</x-ui.card>