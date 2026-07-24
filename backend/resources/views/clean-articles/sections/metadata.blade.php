<x-ui.card>

    <x-ui.section-header
        title="Cleaning Metadata"
        description="Information about the preprocessing result."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Article"
            :value="$cleanArticle->fullArticle?->article?->title"
        />

        <x-ui.description-item
            label="Source"
            :value="$cleanArticle->fullArticle?->article?->source"
        />

        <x-ui.description-item
            label="Cleaner Version"
            :value="$cleanArticle->cleaner_version"
        />

        <x-ui.description-item
            label="Original Word Count"
            :value="number_format($cleanArticle->original_word_count)"
        />

        <x-ui.description-item
            label="Clean Word Count"
            :value="number_format($cleanArticle->clean_word_count)"
        />

        <x-ui.description-item
            label="Cleaned At"
            :value="$cleanArticle->cleaned_at?->format('Y-m-d H:i:s')"
        />

    </x-ui.description-list>

</x-ui.card>