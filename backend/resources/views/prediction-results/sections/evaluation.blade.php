<x-ui.card>

    <x-ui.section-header
        title="Prediction Evaluation"
        description="Comparison between predicted and actual gold price."
    />

    @if($prediction->evaluation)

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <x-ui.stat-card
                title="Actual Price"
                :value="'$' . number_format(
                    $prediction->evaluation->actual_price,
                    2
                ) . ' USD/oz'"
                description="Actual market closing price."
            />

            <x-ui.stat-card
                title="Absolute Error"
                :value="number_format(
                    $prediction->evaluation->absolute_error,
                    6
                )"
                description="Absolute prediction error."
            />

            <x-ui.stat-card
                title="Squared Error"
                :value="number_format(
                    $prediction->evaluation->squared_error,
                    6
                )"
                description="Squared prediction error."
            />

            <x-ui.stat-card
                title="Percentage Error"
                :value="number_format(
                    $prediction->evaluation->percentage_error,
                    2
                ) . '%'"
                description="Percentage prediction error."
            />

        </div>

    @else

        <x-ui.empty-state
            title="Evaluation Not Available"
            description="The actual market price is not available yet."

        />

    @endif

</x-ui.card>