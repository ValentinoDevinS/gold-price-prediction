<x-ui.card>

    @if($sentiments->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Article
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Sentiment
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Positive
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Neutral
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Negative
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Model
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Analyzed At
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($sentiments as $sentiment)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-4">

                                <div class="font-medium text-gray-900">

                                    {{ Str::limit($sentiment->cleanArticle?->fullArticle?->article?->title, 80) }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $sentiment->cleanArticle?->fullArticle?->article?->source }}

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                @php

                                    $variant = match($sentiment->sentiment_label) {

                                        \App\Enums\SentimentLabel::POSITIVE => 'success',

                                        \App\Enums\SentimentLabel::NEUTRAL => 'secondary',

                                        \App\Enums\SentimentLabel::NEGATIVE => 'danger',

                                        default => 'secondary',

                                    };

                                @endphp

                                <x-ui.badge :variant="$variant">

                                    {{ $sentiment->sentiment_label->value }}

                                </x-ui.badge>

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($sentiment->positive_score, 4) }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($sentiment->neutral_score, 4) }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($sentiment->negative_score, 4) }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <div class="font-medium">

                                    {{ $sentiment->model_name }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $sentiment->model_version }}

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $sentiment->analyzed_at?->format('Y-m-d H:i') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route('sentiment-analyses.show', $sentiment->uuid) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $sentiments->withQueryString()->links() }}

        </div>

    @else

        <x-ui.empty-state
            title="No Sentiment Analyses Found"
            description="No sentiment analysis records match the selected criteria."
        />

    @endif

</x-ui.card>