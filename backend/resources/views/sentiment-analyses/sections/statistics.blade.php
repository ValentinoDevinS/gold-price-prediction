<x-ui.grid cols="4">

    <x-ui.stat-card
        title="Total Analyses"
        :value="$sentiments->total()"
        description="Total sentiment analysis records."
    />

    <x-ui.stat-card
        title="Positive"
        :value="$sentiments->where('sentiment_label', \App\Enums\SentimentLabel::POSITIVE)->count()"
        description="Positive sentiment on this page."
    />

    <x-ui.stat-card
        title="Neutral"
        :value="$sentiments->where('sentiment_label', \App\Enums\SentimentLabel::NEUTRAL)->count()"
        description="Neutral sentiment on this page."
    />

    <x-ui.stat-card
        title="Negative"
        :value="$sentiments->where('sentiment_label', \App\Enums\SentimentLabel::NEGATIVE)->count()"
        description="Negative sentiment on this page."
    />

</x-ui.grid>