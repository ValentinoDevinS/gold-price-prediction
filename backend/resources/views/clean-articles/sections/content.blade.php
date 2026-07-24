<x-ui.card>

    <x-ui.section-header
        title="Cleaned Content"
        description="Preprocessed article content used for sentiment analysis."
    />

    <x-ui.text-viewer>

{{ $cleanArticle->clean_content }}

    </x-ui.text-viewer>

</x-ui.card>