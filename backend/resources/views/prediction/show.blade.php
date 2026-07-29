@extends('layouts.app')

@section('title', 'Prediction')

@section('content')

<x-ui.page-header
    title="Prediction"
    description="Prediction result details."
>

<x-slot:actions>

<a
    href="{{ route('prediction.index') }}"
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
                Prediction Information
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>
                <strong>Model</strong>
                <div>{{ $prediction->modelLabel }}</div>
            </div>

            <div>
                <strong>Predicted Price</strong>
                <div>{{ number_format($prediction->predictedPrice, 2) }}</div>
            </div>

            <div>
                <strong>Confidence</strong>
                <div>{{ $prediction->displayConfidence }}</div>
            </div>

            <div>
                <strong>Status</strong>
                <div>{{ $prediction->predictionStatus }}</div>
            </div>

            <div>
                <strong>Prediction Date</strong>
                <div>{{ $prediction->displayPredictionDate }}</div>
            </div>

            <div>
                <strong>Generated At</strong>
                <div>{{ $prediction->displayPredictedAt }}</div>
            </div>

        </div>

    </x-ui.card>

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Article Information
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>
                <strong>Article</strong>
                <div>{{ $prediction->articleTitle }}</div>
            </div>

            <div>
                <strong>Source</strong>
                <div>{{ $prediction->articleSource }}</div>
            </div>

            <div>
                <strong>Language</strong>
                <div>{{ $prediction->language }}</div>
            </div>

        </div>

    </x-ui.card>

</div>

@if($prediction->hasEvaluation)

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Evaluation
            </h2>

        </x-slot:header>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <strong>Actual Price</strong>
                <div>{{ number_format($prediction->actualPrice, 2) }}</div>
            </div>

            <div>
                <strong>Absolute Error</strong>
                <div>{{ number_format($prediction->absoluteError, 2) }}</div>
            </div>

            <div>
                <strong>Percentage Error</strong>
                <div>{{ number_format($prediction->percentageError, 2) }}%</div>
            </div>

            <div>
                <strong>Accuracy</strong>
                <div>{{ number_format($prediction->accuracy, 2) }}%</div>
            </div>

        </div>

    </x-ui.card>

</div>

@endif

@endsection