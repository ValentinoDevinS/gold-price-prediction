@extends('layouts.app')

@section('title', 'Performance')

@section('content')

<x-ui.page-header
    title="Model Performance"
    description="Evaluate machine learning prediction performance using actual gold prices."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Evaluations"
            :value="$dashboard->statistics['total']"
            description="Completed evaluations"
        >
            <x-slot:icon>📊</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="MAE"
            :value="number_format($dashboard->statistics['mae'], 4)"
            description="Mean Absolute Error"
        >
            <x-slot:icon>📈</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="RMSE"
            :value="number_format($dashboard->statistics['rmse'], 4)"
            description="Root Mean Squared Error"
        >
            <x-slot:icon>📉</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="MAPE"
            :value="number_format($dashboard->statistics['mape'], 2).'%'"
            description="Mean Absolute Percentage Error"
        >
            <x-slot:icon>🎯</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Performance Records
                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >
                    {{ $dashboard->table->rows->total() }} Records
                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard->table"
        />

    </x-ui.card>

</div>

@endsection