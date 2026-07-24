<x-ui.card>

    <x-ui.section-header
        title="Metadata"
        description="Original article information."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Source"
            :value="$article->source"
        />

        <x-ui.description-item
            label="Keyword"
            :value="$article->keyword"
        />

        <x-ui.description-item
            label="Country"
            :value="$article->country"
        />

        <x-ui.description-item
            label="Language"
            :value="$article->language"
        />

        <x-ui.description-item
            label="Published"
            :value="optional($article->published_at)?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Scraped"
            :value="optional($article->scraped_at)?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Status"
        >

            <x-ui.status-badge
                :status="$article->status"
            />

        </x-ui.description-item>

    </x-ui.description-list>

</x-ui.card>