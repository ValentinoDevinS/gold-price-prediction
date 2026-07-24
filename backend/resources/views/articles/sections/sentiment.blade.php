@php
    $sentiment = $article->fullArticle?->cleanArticle?->sentimentAnalysis;

    $badgeVariants = [
        'positive' => 'green',
        'neutral' => 'gray',
        'negative' => 'red',
    ];

    $label = strtolower($sentiment?->sentiment_label?->value ?? '');
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Sentiment Analysis"
        description="Financial sentiment analysis generated using the FinBERT model."
    />

    @if($sentiment)

        <div class="space-y-6">

            <x-ui.description-list>

                <x-ui.description-item label="Status">

                    <x-ui.badge variant="green">
                        Completed
                    </x-ui.badge>

                </x-ui.description-item>

                <x-ui.description-item
                    label="Model"
                    :value="$sentiment->model_name"
                />

                <x-ui.description-item
                    label="Version"
                    :value="$sentiment->model_version"
                />

                <x-ui.description-item label="Predicted Sentiment">

                    <x-ui.badge
                        :variant="$badgeVariants[$label] ?? 'gray'"
                    >
                        {{ $sentiment->sentiment_label->value }}
                    </x-ui.badge>

                </x-ui.description-item>

                <x-ui.description-item
                    label="Analyzed At"
                    :value="$sentiment->analyzed_at?->format('Y-m-d H:i:s')"
                />

            </x-ui.description-list>

            <div class="border-t pt-6">

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">

                    Confidence Scores

                </h3>

                <div class="space-y-4">

                    <div>

                        <div class="mb-1 flex justify-between text-sm">

                            <span>Positive</span>

                            <span>{{ number_format($sentiment->positive_score * 100, 2) }}%</span>

                        </div>

                        <div class="h-2 rounded bg-gray-200">

                            <div
                                class="h-2 rounded bg-green-500"
                                style="width: {{ $sentiment->positive_score * 100 }}%"
                            ></div>

                        </div>

                    </div>

                    <div>

                        <div class="mb-1 flex justify-between text-sm">

                            <span>Neutral</span>

                            <span>{{ number_format($sentiment->neutral_score * 100, 2) }}%</span>

                        </div>

                        <div class="h-2 rounded bg-gray-200">

                            <div
                                class="h-2 rounded bg-gray-500"
                                style="width: {{ $sentiment->neutral_score * 100 }}%"
                            ></div>

                        </div>

                    </div>

                    <div>

                        <div class="mb-1 flex justify-between text-sm">

                            <span>Negative</span>

                            <span>{{ number_format($sentiment->negative_score * 100, 2) }}%</span>

                        </div>

                        <div class="h-2 rounded bg-gray-200">

                            <div
                                class="h-2 rounded bg-red-500"
                                style="width: {{ $sentiment->negative_score * 100 }}%"
                            ></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @else

        <x-ui.empty-state
            title="Sentiment Analysis Not Available"
            description="The sentiment analysis process has not completed yet."
        />

    @endif

</x-ui.card>