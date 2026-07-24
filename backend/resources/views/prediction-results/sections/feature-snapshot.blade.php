<x-ui.card>

    <x-ui.section-header
        title="Feature Snapshot"
        description="Feature snapshot used as input for this prediction."
    />

    <x-ui.description-list>

        <x-ui.description-item
            label="Feature Version"
            :value="$prediction->featureSnapshot?->feature_version"
        />

        <x-ui.description-item
            label="Snapshot Date"
            :value="$prediction->featureSnapshot?->snapshot_date?->format('Y-m-d')"
        />

        <x-ui.description-item
            label="Generated At"
            :value="$prediction->featureSnapshot?->generated_at?->format('Y-m-d H:i:s')"
        />

        <x-ui.description-item
            label="Average Sentiment"
            :value="number_format(
                $prediction->featureSnapshot?->average_sentiment ?? 0,
                4
            )"
        />

    </x-ui.description-list>

    <div class="mt-6">

        <a
            href="{{ route(
                'feature-snapshots.show',
                $prediction->featureSnapshot->uuid
            ) }}"
            class="btn btn-primary"
        >
            View Complete Feature Snapshot
        </a>

    </div>

</x-ui.card>