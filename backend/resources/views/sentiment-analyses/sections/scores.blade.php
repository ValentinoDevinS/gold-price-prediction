<x-ui.card>

    <x-ui.section-header
        title="Sentiment Scores"
        description="Confidence scores produced by the sentiment model."
    />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Positive"
            :value="number_format($sentiment->positive_score, 4)"
            description="Positive confidence score."
        />

        <x-ui.stat-card
            title="Neutral"
            :value="number_format($sentiment->neutral_score, 4)"
            description="Neutral confidence score."
        />

        <x-ui.stat-card
            title="Negative"
            :value="number_format($sentiment->negative_score, 4)"
            description="Negative confidence score."
        />

    </div>

</x-ui.card>