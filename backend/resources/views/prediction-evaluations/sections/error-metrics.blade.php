<x-ui.card>

    <x-ui.section-header
        title="Error Metrics"
        description="Prediction error metrics calculated from the actual market price."
    />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <x-ui.stat-card
            title="Absolute Error"
            :value="number_format(
                $evaluation->absolute_error,
                6
            )"
            description="Absolute difference between predicted and actual price."
        />

        <x-ui.stat-card
            title="Squared Error"
            :value="number_format(
                $evaluation->squared_error,
                6
            )"
            description="Squared difference used in RMSE calculation."
        />

        <x-ui.stat-card
            title="Percentage Error"
            :value="number_format(
                $evaluation->percentage_error,
                2
            ) . '%'"
            description="Relative prediction error compared to the actual price."
        />

    </div>

</x-ui.card>