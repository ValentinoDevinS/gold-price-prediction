@php
    $feature = $article->fullArticle?->cleanArticle?->sentimentAnalysis?->featureSnapshot;
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Feature Snapshot"
        description="Features generated for machine learning prediction models."
    />

    @if($feature)

        <div class="space-y-8">

            {{-- ========================================================= --}}
            {{-- Metadata --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Metadata
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item label="Feature Version">
                        {{ $feature->feature_version }}
                    </x-ui.description-item>

                    <x-ui.description-item label="Snapshot Date">
                        {{ $feature->snapshot_date?->format('Y-m-d') }}
                    </x-ui.description-item>

                    <x-ui.description-item label="Generated At">
                        {{ $feature->generated_at?->format('Y-m-d H:i:s') }}
                    </x-ui.description-item>

                </x-ui.description-list>

            </div>

            {{-- ========================================================= --}}
            {{-- Sentiment Features --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Sentiment Features
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item
                        label="Positive Score"
                        :value="number_format($feature->positive_score,6)"
                    />

                    <x-ui.description-item
                        label="Neutral Score"
                        :value="number_format($feature->neutral_score,6)"
                    />

                    <x-ui.description-item
                        label="Negative Score"
                        :value="number_format($feature->negative_score,6)"
                    />

                    <x-ui.description-item
                        label="Average Sentiment"
                        :value="number_format($feature->average_sentiment,6)"
                    />

                </x-ui.description-list>

            </div>

            {{-- ========================================================= --}}
            {{-- Article Features --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Article Features
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item
                        label="Word Count"
                        :value="number_format($feature->word_count)"
                    />

                    <x-ui.description-item
                        label="Article Count"
                        :value="number_format($feature->article_count)"
                    />

                </x-ui.description-list>

            </div>

            {{-- ========================================================= --}}
            {{-- Rolling Features --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Rolling Sentiment
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item
                        label="3 Days"
                        :value="$feature->rolling_sentiment_3d !== null
                            ? number_format($feature->rolling_sentiment_3d,6)
                            : '-'"
                    />

                    <x-ui.description-item
                        label="7 Days"
                        :value="$feature->rolling_sentiment_7d !== null
                            ? number_format($feature->rolling_sentiment_7d,6)
                            : '-'"
                    />

                    <x-ui.description-item
                        label="14 Days"
                        :value="$feature->rolling_sentiment_14d !== null
                            ? number_format($feature->rolling_sentiment_14d,6)
                            : '-'"
                    />

                </x-ui.description-list>

            </div>

            {{-- ========================================================= --}}
            {{-- Time Features --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Time Features
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item
                        label="Weekday"
                        :value="$feature->weekday"
                    />

                    <x-ui.description-item
                        label="Month"
                        :value="$feature->month"
                    />

                    <x-ui.description-item
                        label="Quarter"
                        :value="$feature->quarter"
                    />

                    <x-ui.description-item label="Weekend">

                        <x-ui.badge
                            :variant="$feature->is_weekend ? 'yellow' : 'green'"
                        >
                            {{ $feature->is_weekend ? 'Yes' : 'No' }}
                        </x-ui.badge>

                    </x-ui.description-item>

                </x-ui.description-list>

            </div>

            {{-- ========================================================= --}}
            {{-- Market Features --}}
            {{-- ========================================================= --}}

            <div>

                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-700">
                    Market Features
                </h3>

                <x-ui.description-list>

                    <x-ui.description-item
                        label="Gold Price"
                        :value="$feature->gold_price !== null
                            ? '$'.number_format($feature->gold_price,2)
                            : '-'"
                    />

                    <x-ui.description-item
                        label="Gold Change"
                        :value="$feature->gold_change_percent !== null
                            ? number_format($feature->gold_change_percent,4).' %'
                            : '-'"
                    />

                    <x-ui.description-item
                        label="USD Index"
                        :value="$feature->usd_index !== null
                            ? number_format($feature->usd_index,4)
                            : '-'"
                    />

                    <x-ui.description-item
                        label="ETF Flow"
                        :value="$feature->etf_flow !== null
                            ? number_format($feature->etf_flow,2)
                            : '-'"
                    />

                    <x-ui.description-item
                        label="Trading Volume"
                        :value="$feature->trading_volume !== null
                            ? number_format($feature->trading_volume,2)
                            : '-'"
                    />

                </x-ui.description-list>

            </div>

        </div>

    @else

        <x-ui.empty-state
            title="Feature Snapshot Not Available"
            description="Feature engineering has not generated a snapshot yet."
        />

    @endif

</x-ui.card>