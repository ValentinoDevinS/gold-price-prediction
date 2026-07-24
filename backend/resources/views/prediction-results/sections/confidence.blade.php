<x-ui.card>

    <x-ui.section-header
        title="Prediction Confidence"
        description="Confidence score produced by the prediction model."
    />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <x-ui.stat-card
            title="Confidence Score"
            :value="number_format($prediction->confidence_score * 100, 2) . '%'"
            description="Estimated confidence level of the prediction."
        />

        <x-ui.stat-card
            title="Confidence Level"
            :value="match (true) {
                $prediction->confidence_score >= 0.90 => 'Very High',
                $prediction->confidence_score >= 0.75 => 'High',
                $prediction->confidence_score >= 0.50 => 'Medium',
                default => 'Low',
            }"
            description="Qualitative interpretation of the confidence score."
        />

    </div>

</x-ui.card>