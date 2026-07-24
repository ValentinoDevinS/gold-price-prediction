<x-ui.card>

    <x-ui.section-header
        title="Prediction Evaluation"
        description="Evaluation results of this ensemble prediction."
    />

    @if($ensembleResult->evaluation)

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <x-ui.stat-card
                title="Actual Price"
                :value="'$' . number_format(
                    $ensembleResult->evaluation->actual_price,
                    2
                ) . ' USD/oz'"
                description="Observed market price."
            />

            <x-ui.stat-card
                title="Absolute Error"
                :value="number_format(
                    $ensembleResult->evaluation->absolute_error,
                    6
                )"
                description="Absolute prediction error."
            />

            <x-ui.stat-card
                title="Percentage Error"
                :value="number_format(
                    $ensembleResult->evaluation->percentage_error,
                    2
                ) . '%'"
                description="Relative prediction error."
            />

            <x-ui.stat-card
                title="Evaluated At"
                :value="$ensembleResult
                    ->evaluation
                    ->evaluated_at?->format('Y-m-d')"
                description="Evaluation date."
            />

        </div>

        <div class="mt-6 flex justify-end">

            <a
                href="{{ route(
                    'prediction-evaluations.show',
                    $ensembleResult->evaluation->uuid
                ) }}"
                class="btn btn-primary"
            >
                View Evaluation
            </a>

        </div>

    @else

        <x-ui.empty-state
            title="Not Yet Evaluated"
            description="This ensemble prediction has not been evaluated against the actual market price."
        />

    @endif

</x-ui.card>