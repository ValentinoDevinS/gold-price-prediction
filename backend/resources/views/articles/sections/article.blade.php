<x-ui.card>

    <x-ui.section-header
        title="Original Article"
        description="Information collected during the scraping process."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Title"
            :value="$article->title"
        />

        <x-ui.description-item
            label="Source"
            :value="$article->source"
        />

        <x-ui.description-item
            label="Keyword"
            :value="$article->keyword"
        />

        <x-ui.description-item
            label="Language"
            :value="$article->language"
        />

        <x-ui.description-item
            label="Country"
            :value="$article->country"
        />

        <x-ui.description-item
            label="Published At"
            :value="$article->published_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Scraped At"
            :value="$article->scraped_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item label="URL">

            @if($article->url)

                <a
                    href="{{ $article->url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-blue-600 hover:text-blue-800 hover:underline break-all"
                >
                    {{ $article->url }}
                </a>

            @else

                -

            @endif

        </x-ui.description-item>

        <x-ui.description-item label="Status">

            <x-ui.status-badge
                :status="$article->status"
            />

        </x-ui.description-item>

    </x-ui.description-list>

</x-ui.card>