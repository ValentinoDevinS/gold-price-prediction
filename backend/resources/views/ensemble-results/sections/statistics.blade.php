<x-ui.card>

    <x-ui.section-header
        title="Statistics"
        description="Overview of generated ensemble prediction results."
    />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <x-ui.stat-card
            title="Total Results"
            :value="$ensembleResults->total()"
            description="Total generated ensemble predictions."
        />

        <x-ui.stat-card
            title="Latest Prediction"
            :value="optional(
                $ensembleResults->first()
            )?->prediction_date?->format('Y-m-d') ?? '-'"
            description="Most recent prediction date."
        />

        <x-ui.stat-card
            title="Average Predicted Price"
            :value="'$' . number_format(
                $ensembleResults->getCollection()->avg('predicted_price') ?? 0,
                2
            ) . ' USD/oz'"
            description="Average predicted gold price."
        />

        <x-ui.stat-card
            title="Average Confidence"
            :value="number_format(
                ($ensembleResults->getCollection()->avg('confidence_score') ?? 0) * 100,
                2
            ) . '%'"
            description="Average confidence score."
        />

    </div>

</x-ui.card>