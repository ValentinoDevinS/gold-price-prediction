<x-ui.card>

    <x-ui.section-header
        title="Time Features"
        description="Calendar-based features generated during feature engineering."
    />

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <x-ui.stat-card
            title="Weekday"
            :value="$feature->weekday"
            description="Day of the week."
        />

        <x-ui.stat-card
            title="Month"
            :value="$feature->month"
            description="Month of the snapshot."
        />

        <x-ui.stat-card
            title="Quarter"
            :value="$feature->quarter"
            description="Quarter of the year."
        />

        <x-ui.stat-card
            title="Weekend"
            :value="$feature->is_weekend ? 'Yes' : 'No'"
            description="Whether the snapshot falls on a weekend."
        />

    </div>

</x-ui.card>