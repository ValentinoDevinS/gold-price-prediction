<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Prediction Evaluations
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    View actual gold prices and evaluate prediction accuracy.
                </p>

            </div>

            <a
                href="{{ route('prediction-results.index') }}"
                class="btn btn-secondary"
            >
                Back to Prediction Results
            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @include('prediction-evaluations.sections.statistics')

            @include('prediction-evaluations.sections.filters')

            @include('prediction-evaluations.sections.table')

        </div>

    </div>

</x-app-layout>