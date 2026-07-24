<x-ui.card>

    <x-ui.section-header
        title="Actual Market Price"
        description="Actual gold market price used for prediction evaluation."
    />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Actual Gold Price"
            :value="'$' . number_format(
                $evaluation->actual_price,
                2
            ) . ' USD/oz'"
            description="Observed market closing price."
        />

        <x-ui.stat-card
            title="Market Date"
            :value="$evaluation->actual_price_date?->format('Y-m-d')"
            description="Date of the actual market price."
        />

        <x-ui.stat-card
            title="Evaluation Time"
            :value="$evaluation->evaluated_at?->format('Y-m-d H:i:s')"
            description="When this evaluation was performed."
        />

    </div>

</x-ui.card>