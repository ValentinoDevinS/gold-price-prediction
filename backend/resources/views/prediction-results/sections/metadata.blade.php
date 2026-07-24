<x-ui.card>

    <x-ui.section-header
        title="Prediction Metadata"
        description="General information about this prediction result."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Prediction Model"
            :value="$prediction->model_name"
        />

        <x-ui.description-item
            label="Model Version"
            :value="$prediction->model_version"
        />

        <x-ui.description-item
            label="Prediction Date"
            :value="$prediction->prediction_date?->format('Y-m-d')"
        />

        <x-ui.description-item
            label="Predicted At"
            :value="$prediction->predicted_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Feature Version"
            :value="$prediction->featureSnapshot?->feature_version"
        />

    </x-ui.description-list>

</x-ui.card>