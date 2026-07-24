<x-ui.card>

    <x-ui.section-header
        title="Analysis Metadata"
        description="Information about the sentiment analysis process."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Article"
            :value="$sentiment->cleanArticle?->fullArticle?->article?->title"
        />

        <x-ui.description-item
            label="Source"
            :value="$sentiment->cleanArticle?->fullArticle?->article?->source"
        />

        <x-ui.description-item
            label="Sentiment">

            <x-ui.badge
                :variant="$sentiment->sentiment_label->badgeVariant()"
            >
                {{ $sentiment->sentiment_label->value }}
            </x-ui.badge>

        </x-ui.description-item>

        <x-ui.description-item
            label="Model"
            :value="$sentiment->model_name"
        />

        <x-ui.description-item
            label="Model Version"
            :value="$sentiment->model_version"
        />

        <x-ui.description-item
            label="Analyzed At"
            :value="$sentiment->analyzed_at?->format('Y-m-d H:i:s')"
        />

    </x-ui.description-list>

</x-ui.card>