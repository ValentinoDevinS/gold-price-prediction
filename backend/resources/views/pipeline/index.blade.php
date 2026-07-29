@extends('layouts.app')

@section('title', 'Pipeline Monitor')

@section('content')

<x-ui.page-header
    title="Pipeline Monitor"
    description="Monitor the health and execution status of the AI data processing pipeline."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Stages"
            :value="$dashboard->statistics['total_stages']"
            description="Pipeline stages"
        >
            <x-slot:icon>⚙️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Completed Stages"
            :value="$dashboard->statistics['completed_stages']"
            description="Successfully completed"
        >
            <x-slot:icon>✅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Latest Execution"
            :value="$dashboard->statistics['latest_execution']"
            description="Most recent pipeline activity"
        >
            <x-slot:icon>🕒</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Pipeline Health"
            :value="$dashboard->statistics['pipeline_health']"
            description="Overall pipeline status"
        >
            <x-slot:icon>📡</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Pipeline Stages
                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >
                    {{ $dashboard->table->rows->total() }} Stages
                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard->table"
        />

    </x-ui.card>

</div>

@endsection