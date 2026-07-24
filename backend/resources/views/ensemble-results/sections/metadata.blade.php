<x-ui.card>

    <x-ui.section-header
        title="Ensemble Metadata"
        description="General information about this ensemble prediction result."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Ensemble UUID"
            :value="$ensembleResult->uuid"
        />

        <x-ui.description-item
            label="Ensemble Method"
        >

            <x-ui.badge
                :variant="$ensembleResult->isAverage()
                    ? 'success'
                    : ($ensembleResult->isWeighted()
                        ? 'primary'
                        : ($ensembleResult->isMedian()
                            ? 'warning'
                            : 'secondary'))"
            >
                {{ str_replace('_', ' ', $ensembleResult->ensemble_method) }}
            </x-ui.badge>

        </x-ui.description-item>

        <x-ui.description-item
            label="Model Version"
        >

            <x-ui.badge
                :variant="$ensembleResult->isLatest()
                    ? 'primary'
                    : 'success'"
            >
                {{ ucfirst($ensembleResult->model_version) }}
            </x-ui.badge>

        </x-ui.description-item>

        <x-ui.description-item
            label="Prediction Date"
            :value="$ensembleResult->prediction_date?->format('Y-m-d')"
        />

        <x-ui.description-item
            label="Generated At"
            :value="$ensembleResult->predicted_at?->format('Y-m-d H:i:s')"
        />

    </x-ui.description-list>

</x-ui.card>