@extends('layouts.app')

@section('title', 'Prediction')

@section('content')

<x-ui.page-header
    title="Prediction Dashboard"
    description="Machine learning prediction results generated from the latest feature snapshot."
/>

{{-- Statistics --}}
<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Predictions"
            :value="$dashboard->statistics['total']"
            description="Prediction records"
        >
            <x-slot:icon>🧠</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Today's Predictions"
            :value="$dashboard->statistics['today']"
            description="Generated today"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Evaluated"
            :value="$dashboard->statistics['evaluated']"
            description="Already evaluated"
        >
            <x-slot:icon>✅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Pending Evaluation"
            :value="$dashboard->statistics['pending_evaluation']"
            description="Waiting actual price"
        >
            <x-slot:icon>⏳</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

@if($dashboard->ensemble)

{{-- Individual Models --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

    {{-- LSTM --}}
    <x-ui.card>

        <x-slot:header>
            <h2 class="text-lg font-semibold">
                🧠 LSTM
            </h2>
        </x-slot:header>

        <div class="space-y-3">

            <div>
                <div class="text-sm text-gray-500">Prediction</div>
                <div class="text-2xl font-bold">
                    {{ number_format($dashboard->ensemble->lstm->predictedPrice,2) }}
                </div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Confidence</div>
                <div>
                    {{ $dashboard->ensemble->lstm->displayConfidence }}
                </div>
            </div>

        </div>

    </x-ui.card>

    {{-- CNN --}}
    <x-ui.card>

        <x-slot:header>
            <h2 class="text-lg font-semibold">
                🧠 CNN
            </h2>
        </x-slot:header>

        <div class="space-y-3">

            <div>
                <div class="text-sm text-gray-500">Prediction</div>
                <div class="text-2xl font-bold">
                    {{ number_format($dashboard->ensemble->cnn->predictedPrice,2) }}
                </div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Confidence</div>
                <div>
                    {{ $dashboard->ensemble->cnn->displayConfidence }}
                </div>
            </div>

        </div>

    </x-ui.card>

    {{-- ANN --}}
    <x-ui.card>

        <x-slot:header>
            <h2 class="text-lg font-semibold">
                🧠 ANN
            </h2>
        </x-slot:header>

        <div class="space-y-3">

            <div>
                <div class="text-sm text-gray-500">Prediction</div>
                <div class="text-2xl font-bold">
                    {{ number_format($dashboard->ensemble->ann->predictedPrice,2) }}
                </div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Confidence</div>
                <div>
                    {{ $dashboard->ensemble->ann->displayConfidence }}
                </div>
            </div>

        </div>

    </x-ui.card>

</div>

{{-- Ensemble --}}
<div class="mt-8">

    <x-ui.card>

        <x-slot:header>

            <div class="flex justify-between items-center">

                <h2 class="text-xl font-bold">

                    ⭐ Ensemble Prediction

                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Success">

                    {{ $dashboard->ensemble->consensus }}

                </x-ui.badge>

            </div>

        </x-slot:header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

            <div>

                <div class="text-sm text-gray-500">

                    Average Prediction

                </div>

                <div class="text-2xl font-bold">

                    {{ $dashboard->ensemble->displayAveragePrediction }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    Average Confidence

                </div>

                <div class="text-xl">

                    {{ $dashboard->ensemble->displayAverageConfidence }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    Minimum Prediction

                </div>

                <div>

                    {{ number_format($dashboard->ensemble->minimumPrediction,2) }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    Maximum Prediction

                </div>

                <div>

                    {{ number_format($dashboard->ensemble->maximumPrediction,2) }}

                </div>

            </div>

        </div>

    </x-ui.card>

</div>

{{-- Agreement --}}
<div class="mt-8">

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">

                Agreement Analysis

            </h2>

        </x-slot:header>

        <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">

            <div>

                <div class="text-sm text-gray-500">

                    LSTM ↔ CNN

                </div>

                <div>

                    {{ number_format($dashboard->ensemble->agreement->lstmVsCnn,2) }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    LSTM ↔ ANN

                </div>

                <div>

                    {{ number_format($dashboard->ensemble->agreement->lstmVsAnn,2) }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    CNN ↔ ANN

                </div>

                <div>

                    {{ number_format($dashboard->ensemble->agreement->cnnVsAnn,2) }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    Prediction Spread

                </div>

                <div>

                    {{ $dashboard->ensemble->agreement->displaySpread }}

                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">

                    Average Difference

                </div>

                <div>

                    {{ $dashboard->ensemble->agreement->displayAverageDifference }}

                </div>

            </div>

        </div>

    </x-ui.card>

</div>

@endif

{{-- Prediction History --}}
<div class="mt-8">

    <x-ui.card>

        <x-slot:header>

            <div class="flex justify-between">

                <h2 class="text-lg font-semibold">

                    Prediction History

                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info">

                    {{ $dashboard->table->rows->total() }}
                    Records

                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard->table"
        />

    </x-ui.card>

</div>

@endsection