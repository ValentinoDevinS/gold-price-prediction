<x-ui.card>

    @if($features->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Article
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Version
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Avg. Sentiment
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Gold Price
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Snapshot Date
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Generated
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($features as $feature)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-4">

                                <div class="font-medium text-gray-900">

                                    {{ Str::limit(
                                        $feature->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->title,
                                        80
                                    ) }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $feature->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->source }}

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                <x-ui.badge variant="blue">

                                    {{ $feature->feature_version }}

                                </x-ui.badge>

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($feature->average_sentiment, 4) }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($feature->gold_price, 2) }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $feature->snapshot_date?->format('Y-m-d') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $feature->generated_at?->format('Y-m-d H:i') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route('feature-snapshots.show', $feature->uuid) }}"
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

            {{ $features->withQueryString()->links() }}

        </div>

    @else

        <x-ui.empty-state
            title="No Feature Snapshots Found"
            description="No feature snapshots match the selected criteria."
        />

    @endif

</x-ui.card>