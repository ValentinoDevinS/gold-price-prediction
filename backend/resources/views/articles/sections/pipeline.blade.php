@php
    /**
     * Determine pipeline stage status.
     *
     * Available statuses:
     * - completed
     * - pending
     * - failed (future)
     * - processing (future)
     */

    $stages = [
        [
            'title' => 'Article',
            'description' => 'Article metadata collected.',
            'status' => 'completed',
        ],
        [
            'title' => 'Full Article',
            'description' => 'Article content downloaded.',
            'status' => $article->fullArticle
                ? 'completed'
                : 'pending',
        ],
        [
            'title' => 'Clean Article',
            'description' => 'Article cleaned and normalized.',
            'status' => $article->fullArticle?->cleanArticle
                ? 'completed'
                : 'pending',
        ],
        [
            'title' => 'Sentiment Analysis',
            'description' => 'FinBERT sentiment generated.',
            'status' => $article->fullArticle?->cleanArticle?->sentimentAnalysis
                ? 'completed'
                : 'pending',
        ],
        [
            'title' => 'Feature Snapshot',
            'description' => 'Feature engineering completed.',
            'status' => $article->fullArticle?->cleanArticle?->sentimentAnalysis?->featureSnapshot
                ? 'completed'
                : 'pending',
        ],
        [
            'title' => 'Prediction',
            'description' => 'Prediction model executed.',
            'status' => $article->fullArticle?->cleanArticle?->sentimentAnalysis?->featureSnapshot?->predictionResults?->isNotEmpty()
                ? 'completed'
                : 'pending',
        ],
        [
            'title' => 'Evaluation',
            'description' => 'Prediction evaluated.',
            'status' => $article->fullArticle?->cleanArticle?->sentimentAnalysis?->featureSnapshot?->predictionResults?->first()?->evaluation
                ? 'completed'
                : 'pending',
        ],
    ];

    $statusConfig = [
        'completed' => [
            'dot' => 'bg-green-500',
            'badge' => 'green',
            'label' => 'Completed',
        ],
        'processing' => [
            'dot' => 'bg-yellow-500',
            'badge' => 'yellow',
            'label' => 'Processing',
        ],
        'failed' => [
            'dot' => 'bg-red-500',
            'badge' => 'red',
            'label' => 'Failed',
        ],
        'pending' => [
            'dot' => 'bg-gray-300',
            'badge' => 'gray',
            'label' => 'Pending',
        ],
    ];
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Pipeline Progress"
        description="Current processing status for this article."
    />

    <div class="mt-6">

        @foreach ($stages as $stage)

            @php
                $config = $statusConfig[$stage['status']];
            @endphp

            <div class="flex gap-4">

                <div class="flex flex-col items-center">

                    <div class="h-4 w-4 rounded-full {{ $config['dot'] }}"></div>

                    @unless ($loop->last)
                        <div class="mt-1 w-px flex-1 bg-gray-300 min-h-10"></div>
                    @endunless

                </div>

                <div class="flex-1 pb-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                {{ $stage['title'] }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $stage['description'] }}
                            </p>

                        </div>

                        <x-ui.badge :variant="$config['badge']">
                            {{ $config['label'] }}
                        </x-ui.badge>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</x-ui.card>