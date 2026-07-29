<div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

    <x-ui.stat-card
        title="Current Gold Price"
        :value="'$' . number_format($dashboard->currentGoldPrice, 2)"
        :description="$dashboard->priceChange . '% Today'"
    />

    <x-ui.stat-card
        title="Prediction"
        :value="'$' . number_format($dashboard->predictionPrice, 2)"
        :description="$dashboard->predictionTrend"
    />

    <x-ui.stat-card
        title="Model Accuracy"
        :value="number_format($dashboard->accuracy, 2) . '%'"
        description="MAPE"
    />

    <x-ui.stat-card
        title="Market Sentiment"
        :value="$dashboard->sentiment"
        :description="$dashboard->newsCount . ' Articles'"
    />

</div>