<x-ui.card>

    <x-ui.section-header
        title="Feature Snapshot"
        description="Feature snapshot used to generate this ensemble prediction."
    />

    @if($ensembleResult->featureSnapshot)

        <x-ui.description-list>

            <x-ui.description-item
                label="Feature Snapshot UUID"
                :value="$ensembleResult->featureSnapshot->uuid"
            />

            <x-ui.description-item
                label="Snapshot Date"
                :value="$ensembleResult
                    ->featureSnapshot
                    ->snapshot_date?->format('Y-m-d')"
            />

            <x-ui.description-item
                label="Created At"
                :value="$ensembleResult
                    ->featureSnapshot
                    ->created_at?->format('Y-m-d H:i:s')"
            />

        </x-ui.description-list>

        <div class="mt-6 flex justify-end">

            <a
                href="{{ route(
                    'feature-snapshots.show',
                    $ensembleResult->featureSnapshot->uuid
                ) }}"
                class="btn btn-primary"
            >
                View Feature Snapshot
            </a>

        </div>

    @else

        <x-ui.empty-state
            title="Feature Snapshot Not Available"
            description="The related feature snapshot could not be found."
        />

    @endif

</x-ui.card>