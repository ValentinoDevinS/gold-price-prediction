<x-ui.card>

    <x-ui.section-header
        title="Prediction Information"
        description="Prediction associated with this evaluation."
    />

    @php

        $prediction =

            $evaluation->predictionResult
            ??
            $evaluation->ensembleResult;

    @endphp

    @if($prediction)

        <x-ui.description-list>

            <x-ui.description-item
                label="Prediction UUID"
                :value="$prediction->uuid"
            />

            <x-ui.description-item
                label="Prediction Date"
                :value="$prediction->prediction_date?->format('Y-m-d')"
            />

            <x-ui.description-item
                label="Predicted Price"
                :value="'$' .
                    number_format(
                        $prediction->predicted_price,
                        2
                    ) .
                    ' USD/oz'"
            />

            @if(isset($prediction->model_name))

                <x-ui.description-item
                    label="Prediction Model"
                    :value="$prediction->model_name"
                />

            @endif

            @if(isset($prediction->model_version))

                <x-ui.description-item
                    label="Model Version"
                    :value="$prediction->model_version"
                />

            @endif

        </x-ui.description-list>

        <div class="mt-6 flex justify-end">

            @if($evaluation->predictionResult)

                <a
                    href="{{ route(
                        'prediction-results.show',
                        $prediction->uuid
                    ) }}"
                    class="btn btn-primary"
                >
                    View Prediction Result
                </a>

            @endif

        </div>

    @else

        <x-ui.empty-state
            title="Prediction Not Available"
            description="The associated prediction record could not be found."
        />

    @endif

</x-ui.card>