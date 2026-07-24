<x-ui.card>

    @if($predictions->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Article
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Model
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Version
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Predicted Price
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Confidence
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Prediction Date
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($predictions as $prediction)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-4">

                                <div class="font-medium text-gray-900">

                                    {{ Str::limit(
                                        $prediction->featureSnapshot?->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->title,
                                        80
                                    ) }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $prediction->featureSnapshot?->sentimentAnalysis?->cleanArticle?->fullArticle?->article?->source }}

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                <x-ui.badge
                                    :variant="match($prediction->model_name) {
                                        'LSTM' => 'blue',
                                        'CNN' => 'green',
                                        'ANN' => 'yellow',
                                        'ENSEMBLE' => 'purple',
                                        default => 'gray',
                                    }"
                                >

                                    {{ $prediction->model_name }}

                                </x-ui.badge>

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $prediction->model_version }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($prediction->predicted_price, 2) }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($prediction->confidence_score * 100, 2) }}%

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $prediction->prediction_date?->format('Y-m-d') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route('prediction-results.show', $prediction->uuid) }}"
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

            {{ $predictions->withQueryString()->links() }}

        </div>

    @else

        <x-ui.empty-state
            title="No Prediction Results Found"
            description="No prediction results match the selected criteria."
        />

    @endif

</x-ui.card>