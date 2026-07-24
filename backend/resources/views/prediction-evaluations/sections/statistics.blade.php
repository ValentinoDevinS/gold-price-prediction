<x-ui.card>

    <x-ui.section-header
        title="Evaluation Statistics"
        description="Overview of prediction evaluation results."
    />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <x-ui.stat-card
            title="Total Evaluations"
            :value="$evaluations->total()"
            description="Total evaluated predictions."
        />

        <x-ui.stat-card
            title="Latest Evaluation"
            :value="optional(
                $evaluations->first()
            )?->evaluated_at?->format('Y-m-d') ?? '-'"
            description="Most recent evaluation date."
        />

        <x-ui.stat-card
            title="Average Absolute Error"
            :value="number_format(
                $evaluations->getCollection()->avg('absolute_error') ?? 0,
                4
            )"
            description="Average absolute prediction error."
        />

        <x-ui.stat-card
            title="Average Percentage Error"
            :value="number_format(
                $evaluations->getCollection()->avg('percentage_error') ?? 0,
                2
            ) . '%'"
            description="Average percentage prediction error."
        />

    </div>

</x-ui.card>