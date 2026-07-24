<x-ui.grid cols="4">

    <x-ui.stat-card
        title="Total Clean Articles"
        :value="$cleanArticles->total()"
        description="Cleaned articles available."
    />

    <x-ui.stat-card
        title="Average Words"
        :value="number_format($cleanArticles->avg('clean_word_count') ?? 0)"
        description="Average cleaned article length."
    />

    <x-ui.stat-card
        title="Largest Article"
        :value="number_format($cleanArticles->max('clean_word_count') ?? 0)"
        description="Highest clean word count."
    />

    <x-ui.stat-card
        title="Latest Cleaning"
        :value="optional($cleanArticles->first()?->cleaned_at)->format('Y-m-d') ?? '-'"
        description="Most recently cleaned article."
    />

</x-ui.grid>