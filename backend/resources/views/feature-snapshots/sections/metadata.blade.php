<x-ui.card>

    <x-ui.section-header
        title="Snapshot Metadata"
        description="General information about this generated feature snapshot."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Article"
            :value="$feature->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->title"
        />

        <x-ui.description-item
            label="Source"
            :value="$feature->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->source"
        />

        <x-ui.description-item
            label="Feature Version"
            :value="$feature->feature_version"
        />

        <x-ui.description-item
            label="Snapshot Date"
            :value="$feature->snapshot_date?->format('Y-m-d')"
        />

        <x-ui.description-item
            label="Generated At"
            :value="$feature->generated_at?->format('Y-m-d H:i:s')"
        />

    </x-ui.description-list>

</x-ui.card>