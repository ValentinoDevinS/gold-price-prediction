<x-ui.card>

    <x-slot:header>
        <div>
            <h2 class="text-lg font-semibold text-text">
                Latest Articles
            </h2>

            <p class="mt-1 text-sm text-text-secondary">
                Recently collected news articles.
            </p>
        </div>
    </x-slot:header>

    @forelse ($latestArticles as $article)

        <div class="border-b border-border py-4 last:border-b-0">

            <h3 class="font-medium text-text">
                {{ $article['title'] }}
            </h3>

            <p class="mt-1 text-sm text-text-secondary">
                {{ $article['published_at'] }}
            </p>

        </div>

    @empty

        <div class="py-10 text-center text-text-secondary">
            No articles available.
        </div>

    @endforelse

</x-ui.card>