<x-ui.table>
    <x-ui.table-head>
        <tr>
            <x-ui.table-cell header>Title</x-ui.table-cell>
            <x-ui.table-cell header>Source</x-ui.table-cell>
            <x-ui.table-cell header>Status</x-ui.table-cell>
            <x-ui.table-cell header class="text-center">Action</x-ui.table-cell>
        </tr>
    </x-ui.table-head>

    <x-ui.table-body>
        @foreach($articles as $article)
            <x-ui.table-row>
                <x-ui.table-cell>{{ $article->title }}</x-ui.table-cell>
                <x-ui.table-cell>{{ $article->source }}</x-ui.table-cell>
                <x-ui.table-cell>
                    <x-ui.status-badge :status="$article->status" />
                </x-ui.table-cell>
                <x-ui.table-cell class="text-center">
                    <x-ui.button
                        size="sm"
                        :href="route('articles.show', $article->uuid)"
                    >
                        View Pipeline
                    </x-ui.button>
                </x-ui.table-cell>
            </x-ui.table-row>
        @endforeach
    </x-ui.table-body>
</x-ui.table>