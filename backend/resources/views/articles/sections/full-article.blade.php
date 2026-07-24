@php
    $fullArticle = $article->fullArticle;
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Full Article"
        description="Original content downloaded from the source website."
    />

    @if ($fullArticle)

        <div class="space-y-6">

            <x-ui.description-list>

                <x-ui.description-item
                    label="Download Status"
                >
                    <x-ui.badge variant="green">
                        Downloaded
                    </x-ui.badge>
                </x-ui.description-item>

                <x-ui.description-item
                    label="Content Length"
                    :value="number_format(strlen($fullArticle->content ?? '')) . ' characters'"
                />

                <x-ui.description-item
                    label="Downloaded At"
                    :value="$fullArticle->created_at?->format('Y-m-d H:i:s')"
                />

                @if(!empty($fullArticle->updated_at))

                    <x-ui.description-item
                        label="Last Updated"
                        :value="$fullArticle->updated_at?->format('Y-m-d H:i:s')"
                    />

                @endif

            </x-ui.description-list>

            <div>

                <h3 class="mb-3 text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Downloaded Content
                </h3>

                <div
                    class="rounded-lg border border-gray-200 bg-gray-50 p-4 max-h-[500px] overflow-y-auto"
                >
                    <pre class="whitespace-pre-wrap break-words text-sm text-gray-800 font-sans">{{ $fullArticle->content }}</pre>
                </div>

            </div>

        </div>

    @else

        <x-ui.empty-state
            title="Full Article Not Available"
            description="The downloader has not retrieved the article content yet."
        />

    @endif

</x-ui.card>