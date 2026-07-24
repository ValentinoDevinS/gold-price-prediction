@php
    $cleanArticle = $article->fullArticle?->cleanArticle;
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Clean Article"
        description="Normalized article content after preprocessing."
    />

    @if ($cleanArticle)

        <div class="space-y-6">

            <x-ui.description-list>

                <x-ui.description-item
                    label="Processing Status"
                >
                    <x-ui.badge variant="green">
                        Completed
                    </x-ui.badge>
                </x-ui.description-item>

                <x-ui.description-item
                    label="Content Length"
                    :value="number_format(strlen($cleanArticle->content ?? '')) . ' characters'"
                />

                <x-ui.description-item
                    label="Created At"
                    :value="$cleanArticle->created_at?->format('Y-m-d H:i:s')"
                />

                @if($cleanArticle->updated_at)

                    <x-ui.description-item
                        label="Last Updated"
                        :value="$cleanArticle->updated_at?->format('Y-m-d H:i:s')"
                    />

                @endif

            </x-ui.description-list>

            <div>

                <h3 class="mb-3 text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Cleaned Content
                </h3>

                <x-ui.text-viewer>

                    {{ $cleanArticle->content }}

                </x-ui.text-viewer>

            </div>

        </div>

    @else

        <x-ui.empty-state
            title="Clean Article Not Available"
            description="The preprocessing service has not generated cleaned content yet."
        />

    @endif

</x-ui.card>