<x-ui.card>

    <x-ui.section-header
        title="Ensemble Results"
        description="Generated ensemble prediction results."
    />

    <div class="overflow-x-auto">

        <table class="table w-full">

            <thead>

                <tr>

                    <th>Method</th>

                    <th>Version</th>

                    <th>Predicted Price</th>

                    <th>Confidence</th>

                    <th>Prediction Date</th>

                    <th>Predicted At</th>

                    <th class="text-right">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($ensembleResults as $ensemble)

                    <tr>

                        <td>

                            <x-ui.badge
                                :variant="$ensemble->isAverage()
                                    ? 'success'
                                    : ($ensemble->isWeighted()
                                        ? 'primary'
                                        : ($ensemble->isMedian()
                                            ? 'warning'
                                            : 'secondary'))"
                            >

                                {{ str_replace('_', ' ', $ensemble->ensemble_method) }}

                            </x-ui.badge>

                        </td>

                        <td>

                            <x-ui.badge
                                :variant="$ensemble->isLatest()
                                    ? 'primary'
                                    : 'success'"
                            >

                                {{ ucfirst($ensemble->model_version) }}

                            </x-ui.badge>

                        </td>

                        <td>

                            ${{ number_format(
                                $ensemble->predicted_price,
                                2
                            ) }}

                        </td>

                        <td>

                            {{ number_format(
                                $ensemble->confidence_score * 100,
                                2
                            ) }}%

                        </td>

                        <td>

                            {{ $ensemble->prediction_date?->format('Y-m-d') }}

                        </td>

                        <td>

                            {{ $ensemble->predicted_at?->format('Y-m-d H:i') }}

                        </td>

                        <td class="text-right">

                            <a
                                href="{{ route(
                                    'ensemble-results.show',
                                    $ensemble->uuid
                                ) }}"
                                class="btn btn-sm btn-primary"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-8 text-gray-500"
                        >

                            No ensemble results found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $ensembleResults->withQueryString()->links() }}

    </div>

</x-ui.card>