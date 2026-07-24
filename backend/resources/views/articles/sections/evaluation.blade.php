@php
    $predictions = $article->fullArticle
        ?->cleanArticle
        ?->sentimentAnalysis
        ?->featureSnapshot
        ?->predictionResults
        ?? collect();
@endphp

<x-ui.card>

    <x-ui.section-header
        title="Prediction Evaluation"
        description="Comparison between predicted and actual market prices."
    />

    @if($predictions->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                            Model
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                            Predicted
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                            Actual
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                            Absolute Error
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                            Squared Error
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase">
                            Percentage Error
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                            Evaluated At
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($predictions as $prediction)

                        @php
                            $evaluation = $prediction->evaluation;
                        @endphp

                        <tr>

                            <td class="px-4 py-4">

                                <x-ui.badge
                                    :variant="match($prediction->model_name){
                                        'LSTM' => 'blue',
                                        'CNN' => 'purple',
                                        'ANN' => 'green',
                                        'ENSEMBLE' => 'yellow',
                                        default => 'gray'
                                    }"
                                >
                                    {{ $prediction->model_name }}
                                </x-ui.badge>

                            </td>

                            @if($evaluation)

                                <td class="px-4 py-4 text-right">

                                    ${{ number_format($prediction->predicted_price,2) }}

                                </td>

                                <td class="px-4 py-4 text-right">

                                    ${{ number_format($evaluation->actual_price,2) }}

                                </td>

                                <td class="px-4 py-4 text-right">

                                    {{ number_format($evaluation->absolute_error,6) }}

                                </td>

                                <td class="px-4 py-4 text-right">

                                    {{ number_format($evaluation->squared_error,6) }}

                                </td>

                                <td class="px-4 py-4 text-right">

                                    {{ number_format($evaluation->percentage_error,2) }}%

                                </td>

                                <td class="px-4 py-4 text-center">

                                    {{ $evaluation->evaluated_at?->format('Y-m-d H:i:s') }}

                                </td>

                            @else

                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">

                                    Evaluation has not been generated.

                                </td>

                            @endif

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <x-ui.empty-state
            title="Prediction Evaluation Not Available"
            description="Prediction results have not been evaluated yet."
        />

    @endif

</x-ui.card>