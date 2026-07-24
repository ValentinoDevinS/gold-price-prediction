@extends('layouts.app')

@section('title', 'Ensemble Result Details')

@section('content')

<div class="container mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-2xl font-bold">
                Ensemble Result Details
            </h1>

            <p class="text-gray-500 mt-1">
                Detailed information about the generated ensemble prediction.
            </p>

        </div>

        <div class="flex gap-2">

            @if($ensembleResult->evaluation)

                <a
                    href="{{ route(
                        'prediction-evaluations.show',
                        $ensembleResult->evaluation->uuid
                    ) }}"
                    class="btn btn-success"
                >
                    View Evaluation
                </a>

            @endif

            <a
                href="{{ route('ensemble-results.index') }}"
                class="btn btn-secondary"
            >
                Back
            </a>

        </div>

    </div>

    <div class="space-y-6">

        @include('ensemble-results.sections.metadata')

        @include('ensemble-results.sections.prediction')

        @include('ensemble-results.sections.confidence')

        @include('ensemble-results.sections.feature-snapshot')

        @include('ensemble-results.sections.evaluation')

    </div>

</div>

@endsection