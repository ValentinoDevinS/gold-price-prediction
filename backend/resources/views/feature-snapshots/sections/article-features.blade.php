<x-ui.card>

    <x-ui.section-header
        title="Article Features"
        description="Document-level features generated during feature engineering."
    />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Word Count"
            :value="number_format($feature->word_count)"
            description="Number of cleaned words."
        />

        <x-ui.stat-card
            title="Article Count"
            :value="number_format($feature->article_count)"
            description="Articles included in this snapshot."
        />

        <x-ui.stat-card
            title="Average Sentiment"
            :value="number_format($feature->average_sentiment, 4)"
            description="Average sentiment score."
        />

    </div>

</x-ui.card>