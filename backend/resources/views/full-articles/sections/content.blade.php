<x-ui.card>

    <x-ui.section-header
        title="Downloaded Content"
        description="Raw content extracted from the source website."
    />

    <x-ui.text-viewer>

{{ $fullArticle->content }}

    </x-ui.text-viewer>

</x-ui.card>