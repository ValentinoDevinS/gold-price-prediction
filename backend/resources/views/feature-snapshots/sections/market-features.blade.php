<x-ui.card>

    <x-ui.section-header
        title="Market Features"
        description="Market indicators combined with NLP features for prediction."
    />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

        <x-ui.stat-card
            title="Gold Price"
            :value="number_format($feature->gold_price, 2)"
            description="Gold closing price."
        />

        <x-ui.stat-card
            title="Gold Change"
            :value="number_format($feature->gold_change_percent, 2) . '%'"
            description="Daily percentage change."
        />

        <x-ui.stat-card
            title="USD Index"
            :value="$feature->usd_index !== null
                ? number_format($feature->usd_index, 2)
                : '-'"
            description="US Dollar Index (DXY)."
        />

        <x-ui.stat-card
            title="ETF Flow"
            :value="$feature->etf_flow !== null
                ? number_format($feature->etf_flow, 2)
                : '-'"
            description="Daily ETF flow."
        />

        <x-ui.stat-card
            title="Trading Volume"
            :value="$feature->trading_volume !== null
                ? number_format($feature->trading_volume)
                : '-'"
            description="Daily trading volume."
        />

    </div>

</x-ui.card>