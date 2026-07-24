<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Prediction Evaluation Details
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Detailed evaluation of the prediction against the actual gold price.
                </p>

            </div>

            <div class="flex items-center gap-2">

                @if($evaluation->predictionResult)

                    <a
                        href="{{ route(
                            'prediction-results.show',
                            $evaluation->predictionResult->uuid
                        ) }}"
                        class="btn btn-secondary"
                    >
                        View Prediction
                    </a>

                @endif

                <a
                    href="{{ route('prediction-evaluations.index') }}"
                    class="btn btn-secondary"
                >
                    Back
                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @include('prediction-evaluations.sections.metadata')

            @include('prediction-evaluations.sections.actual-price')

            @include('prediction-evaluations.sections.error-metrics')

            @include('prediction-evaluations.sections.prediction-result')

        </div>

    </div>

</x-app-layout>