@extends('layouts.app')

@section('title', 'Performance')

@section('content')

<x-ui.page-header
    title="Performance Details"
    description="Prediction evaluation details."
>

<x-slot:actions>

<a
    href="{{ route('performance.index') }}"
    class="btn btn-secondary"
>
    ← Back
</a>

</x-slot:actions>

</x-ui.page-header>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Prediction
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>
                <strong>Article</strong>
                <div>{{ $performance->articleTitle }}</div>
            </div>

            <div>
                <strong>Model</strong>
                <div>{{ $performance->modelLabel }}</div>
            </div>

            <div>
                <strong>Predicted Price</strong>
                <div>{{ number_format($performance->predictedPrice, 2) }}</div>
            </div>

            <div>
                <strong>Confidence</strong>
                <div>{{ $performance->displayConfidence }}</div>
            </div>

            <div>
                <strong>Prediction Date</strong>
                <div>{{ $performance->displayPredictionDate }}</div>
            </div>

        </div>

    </x-ui.card>

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Evaluation
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>
                <strong>Actual Price</strong>
                <div>{{ number_format($performance->actualPrice, 2) }}</div>
            </div>

            <div>
                <strong>Absolute Error</strong>
                <div>{{ number_format($performance->absoluteError, 6) }}</div>
            </div>

            <div>
                <strong>Squared Error</strong>
                <div>{{ number_format($performance->squaredError, 6) }}</div>
            </div>

            <div>
                <strong>MAPE</strong>
                <div>{{ number_format($performance->percentageError, 4) }}%</div>
            </div>

            <div>
                <strong>Grade</strong>
                <div>{{ $performance->performanceGrade }}</div>
            </div>

            <div>
                <strong>Evaluation Date</strong>
                <div>{{ $performance->displayEvaluatedAt }}</div>
            </div>

        </div>

    </x-ui.card>

</div>

@endsection