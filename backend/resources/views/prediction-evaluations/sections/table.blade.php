<x-ui.card>

    <x-ui.section-header
        title="Prediction Evaluation List"
        description="Evaluation results for predicted gold prices."
    />

    <div class="overflow-x-auto">

        <table class="table">

            <thead>

                <tr>

                    <th>Prediction Model</th>

                    <th>Prediction Date</th>

                    <th>Actual Price</th>

                    <th>Absolute Error</th>

                    <th>Percentage Error</th>

                    <th>Evaluated At</th>

                    <th class="text-right">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($evaluations as $evaluation)

                    <tr>

                        <td>

                            @if($evaluation->predictionResult)

                                <x-ui.badge
                                    :variant="$evaluation->predictionResult->badgeVariant()"
                                >
                                    {{ $evaluation->predictionResult->model_name }}
                                </x-ui.badge>

                            @elseif($evaluation->ensembleResult)

                                <x-ui.badge variant="purple">
                                    Ensemble
                                </x-ui.badge>

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            {{ optional(
                                $evaluation->predictionResult
                            )?->prediction_date?->format('Y-m-d') ?? '-' }}

                        </td>

                        <td>

                            ${{ number_format(
                                $evaluation->actual_price,
                                2
                            ) }}

                        </td>

                        <td>

                            {{ number_format(
                                $evaluation->absolute_error,
                                4
                            ) }}

                        </td>

                        <td>

                            {{ number_format(
                                $evaluation->percentage_error,
                                2
                            ) }}%

                        </td>

                        <td>

                            {{ $evaluation->evaluated_at?->format('Y-m-d H:i') }}

                        </td>

                        <td class="text-right">

                            <a
                                href="{{ route(
                                    'prediction-evaluations.show',
                                    $evaluation->uuid
                                ) }}"
                                class="btn btn-sm btn-primary"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7">

                            <x-ui.empty-state
                                title="No Evaluations Found"
                                description="There are no prediction evaluations matching the selected filters."
                            />

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $evaluations->withQueryString()->links() }}

    </div>

</x-ui.card>