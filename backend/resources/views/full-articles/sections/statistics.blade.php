<x-ui.grid cols="4">

    <x-ui.stat-card
        title="Total Articles"
        :value="$fullArticles->total()"
    />

    <x-ui.stat-card
        title="Downloaded"
        :value="$fullArticles->where('download_status', 'completed')->count()"
    />

    <x-ui.stat-card
        title="Pending"
        :value="$fullArticles->where('download_status', 'pending')->count()"
    />

    <x-ui.stat-card
        title="Average Words"
        :value="number_format($fullArticles->avg('word_count') ?? 0)"
    />

</x-ui.grid>