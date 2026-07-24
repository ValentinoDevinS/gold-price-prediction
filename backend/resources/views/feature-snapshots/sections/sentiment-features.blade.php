<x-ui.card>

    <x-ui.section-header
        title="Sentiment Features"
        description="Sentiment values extracted from the FinBERT analysis."
    />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Positive Score"
            :value="number_format($feature->positive_score, 4)"
            description="Positive sentiment probability."
        />

        <x-ui.stat-card
            title="Neutral Score"
            :value="number_format($feature->neutral_score, 4)"
            description="Neutral sentiment probability."
        />

        <x-ui.stat-card
            title="Negative Score"
            :value="number_format($feature->negative_score, 4)"
            description="Negative sentiment probability."
        />

    </div>

</x-ui.card>