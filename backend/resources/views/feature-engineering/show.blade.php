@extends('layouts.app')

@section('title', 'Feature Engineering')

@section('content')

<x-ui.page-header
    title="Feature Engineering"
    description="Generated machine learning features."
>

<x-slot:actions>

<a
    href="{{ route('feature-engineering.index') }}"
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
                Source Information
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>
                <strong>Article</strong>
                <div>{{ $feature->articleTitle }}</div>
            </div>

            <div>
                <strong>Source</strong>
                <div>{{ $feature->articleSource }}</div>
            </div>

            <div>
                <strong>Language</strong>
                <div>{{ $feature->language }}</div>
            </div>

            <div>
                <strong>Feature Version</strong>
                <div>{{ $feature->featureVersion }}</div>
            </div>

            <div>
                <strong>Snapshot Date</strong>
                <div>{{ $feature->displayDate }}</div>
            </div>

            <div>
                <strong>Status</strong>
                <div>{{ $feature->predictionStatus }}</div>
            </div>

        </div>

    </x-ui.card>

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Engineered Features
            </h2>

        </x-slot:header>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <strong>Positive</strong>
                <div>{{ number_format($feature->positiveScore,4) }}</div>
            </div>

            <div>
                <strong>Neutral</strong>
                <div>{{ number_format($feature->neutralScore,4) }}</div>
            </div>

            <div>
                <strong>Negative</strong>
                <div>{{ number_format($feature->negativeScore,4) }}</div>
            </div>

            <div>
                <strong>Average</strong>
                <div>{{ number_format($feature->averageSentiment,4) }}</div>
            </div>

            <div>
                <strong>Word Count</strong>
                <div>{{ $feature->wordCount }}</div>
            </div>

            <div>
                <strong>Article Count</strong>
                <div>{{ $feature->articleCount }}</div>
            </div>

            <div>
                <strong>Rolling 3 Days</strong>
                <div>{{ number_format($feature->rollingSentiment3d ?? 0,4) }}</div>
            </div>

            <div>
                <strong>Rolling 7 Days</strong>
                <div>{{ number_format($feature->rollingSentiment7d ?? 0,4) }}</div>
            </div>

            <div>
                <strong>Rolling 14 Days</strong>
                <div>{{ number_format($feature->rollingSentiment14d ?? 0,4) }}</div>
            </div>

            <div>
                <strong>Weekday</strong>
                <div>{{ $feature->weekdayName }}</div>
            </div>

            <div>
                <strong>Gold Price</strong>
                <div>{{ number_format($feature->goldPrice ?? 0,2) }}</div>
            </div>

            <div>
                <strong>USD Index</strong>
                <div>{{ number_format($feature->usdIndex ?? 0,2) }}</div>
            </div>

        </div>

    </x-ui.card>

</div>

@endsection