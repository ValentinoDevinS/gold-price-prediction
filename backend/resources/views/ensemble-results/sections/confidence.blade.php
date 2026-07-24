<x-ui.card>

    <x-ui.section-header
        title="Prediction Confidence"
        description="Confidence score of the ensemble prediction."
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <x-ui.stat-card
            title="Confidence Score"
            :value="number_format(
                $ensembleResult->confidence_score * 100,
                2
            ) . '%'"
            description="Overall confidence of the ensemble prediction."
        />

        <div class="bg-white rounded-lg border p-6">

            <div class="text-sm text-gray-500">
                Confidence Level
            </div>

            <div class="mt-3">

                @php

                    $confidence = $ensembleResult->confidence_score * 100;

                @endphp

                @if($confidence >= 90)

                    <x-ui.badge variant="success">
                        Excellent
                    </x-ui.badge>

                @elseif($confidence >= 80)

                    <x-ui.badge variant="primary">
                        High
                    </x-ui.badge>

                @elseif($confidence >= 70)

                    <x-ui.badge variant="warning">
                        Moderate
                    </x-ui.badge>

                @else

                    <x-ui.badge variant="danger">
                        Low
                    </x-ui.badge>

                @endif

            </div>

            <p class="text-sm text-gray-500 mt-4">

                Confidence represents the agreement between the
                prediction models used to generate the ensemble result.

            </p>

        </div>

    </div>

</x-ui.card>