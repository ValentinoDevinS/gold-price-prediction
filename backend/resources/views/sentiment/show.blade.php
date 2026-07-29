@extends('layouts.app')

@section('title', 'Sentiment Details')

@section('content')

<x-ui.page-header
    title="Sentiment Details"
    description="FinBERT prediction result."
>

<x-slot:actions>

<a
    href="{{ route('sentiment.index') }}"
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
                Article
            </h2>

        </x-slot:header>

        <div class="space-y-4">

            <div>

                <strong>Title</strong>

                <div>
                    {{ $sentiment->articleTitle }}
                </div>

            </div>

            <div>

                <strong>Source</strong>

                <div>
                    {{ $sentiment->articleSource }}
                </div>

            </div>

            <div>

                <strong>Language</strong>

                <div>
                    {{ $sentiment->language }}
                </div>

            </div>

            <div>

                <strong>Clean Text</strong>

                <div class="whitespace-pre-line text-sm">
                    {{ $sentiment->cleanContent }}
                </div>

            </div>

        </div>

    </x-ui.card>

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                FinBERT Result
            </h2>

        </x-slot:header>

        <div class="space-y-5">

            <div>

                <strong>Prediction</strong>

                <div>
                    {{ ucfirst($sentiment->label) }}
                </div>

            </div>

            <div>

                <strong>Confidence</strong>

                <div>
                    {{ number_format($sentiment->confidence * 100, 2) }}%
                </div>

            </div>

            <div>

                <strong>Positive Score</strong>

                <div>
                    {{ number_format($sentiment->positiveScore, 4) }}
                </div>

            </div>

            <div>

                <strong>Neutral Score</strong>

                <div>
                    {{ number_format($sentiment->neutralScore, 4) }}
                </div>

            </div>

            <div>

                <strong>Negative Score</strong>

                <div>
                    {{ number_format($sentiment->negativeScore, 4) }}
                </div>

            </div>

            <div>

                <strong>Model</strong>

                <div>
                    {{ $sentiment->modelName }}
                    ({{ $sentiment->modelVersion }})
                </div>

            </div>

            <div>

                <strong>Analyzed At</strong>

                <div>
                    {{ $sentiment->analyzedAt?->format('Y-m-d H:i:s') }}
                </div>

            </div>

        </div>

    </x-ui.card>

</div>

@endsection