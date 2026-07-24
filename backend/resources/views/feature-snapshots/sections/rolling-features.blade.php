<x-ui.card>

    <x-ui.section-header
        title="Rolling Features"
        description="Rolling sentiment statistics generated during feature engineering."
    />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Rolling 3 Days"
            :value="number_format($feature->rolling_sentiment_3d, 4)"
            description="Average sentiment over the last 3 days."
        />

        <x-ui.stat-card
            title="Rolling 7 Days"
            :value="number_format($feature->rolling_sentiment_7d, 4)"
            description="Average sentiment over the last 7 days."
        />

        <x-ui.stat-card
            title="Rolling 14 Days"
            :value="number_format($feature->rolling_sentiment_14d, 4)"
            description="Average sentiment over the last 14 days."
        />

    </div>

</x-ui.card>