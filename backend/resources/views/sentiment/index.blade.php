@extends('layouts.app')

@section('title', 'Sentiment Analysis')

@section('content')

<x-ui.page-header
    title="Sentiment Analysis"
    description="FinBERT sentiment analysis results for collected articles."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total"
            :value="$dashboard['statistics']['total']"
            description="Total analyses"
        >
            <x-slot:icon>🧠</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Positive"
            :value="$dashboard['statistics']['positive']"
            description="Positive sentiment"
        >
            <x-slot:icon>📈</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Neutral"
            :value="$dashboard['statistics']['neutral']"
            description="Neutral sentiment"
        >
            <x-slot:icon>➖</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Negative"
            :value="$dashboard['statistics']['negative']"
            description="Negative sentiment"
        >
            <x-slot:icon>📉</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Sentiment Results
                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >
                    {{ $dashboard['table']->rows->total() }} Records
                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard['table']"
        />

    </x-ui.card>

</div>

@endsection