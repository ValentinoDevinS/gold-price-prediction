<x-ui.card>

    <x-ui.section-header
        title="Metadata"
        description="Downloaded article information."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Article"
            :value="$fullArticle->article?->title"
        />

        <x-ui.description-item
            label="Source"
            :value="$fullArticle->article?->source"
        />

        <x-ui.description-item
            label="Author"
            :value="$fullArticle->author"
        />

        <x-ui.description-item
            label="Word Count"
            :value="number_format($fullArticle->word_count)"
        />

        <x-ui.description-item
            label="Downloaded At"
            :value="$fullArticle->downloaded_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item label="Status">

            <x-ui.status-badge
                :status="$fullArticle->download_status"
            />

        </x-ui.description-item>

    </x-ui.description-list>

</x-ui.card>