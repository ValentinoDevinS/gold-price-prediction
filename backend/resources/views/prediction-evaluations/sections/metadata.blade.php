<x-ui.card>

    <x-ui.section-header
        title="Evaluation Metadata"
        description="General information about this prediction evaluation."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Evaluation UUID"
            :value="$evaluation->uuid"
        />

        <x-ui.description-item
            label="Evaluation Type"
            :value="$evaluation->predictionResult
                ? 'Prediction Result'
                : 'Ensemble Result'"
        />

        <x-ui.description-item
            label="Actual Price Date"
            :value="$evaluation->actual_price_date?->format('Y-m-d')"
        />

        <x-ui.description-item
            label="Evaluated At"
            :value="$evaluation->evaluated_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Prediction UUID"
            :value="$evaluation->predictionResult?->uuid
                ?? $evaluation->ensembleResult?->uuid
                ?? '-'"
        />

    </x-ui.description-list>

</x-ui.card>