<x-ui.grid cols="4">

    <x-ui.stat-card
        title="Total Predictions"
        :value="$predictions->total()"
        description="Generated prediction results."
    />

    <x-ui.stat-card
        title="Latest Prediction"
        :value="optional($predictions->first()?->prediction_date)->format('Y-m-d') ?? '-'"
        description="Most recent prediction date."
    />

    <x-ui.stat-card
        title="Latest Model"
        :value="$predictions->first()?->model_name ?? '-'"
        description="Latest prediction model."
    />

    <x-ui.stat-card
        title="Average Confidence"
        :value="number_format($predictions->avg('confidence_score') * 100, 2) . '%'"
        description="Average confidence score on this page."
    />

</x-ui.grid>