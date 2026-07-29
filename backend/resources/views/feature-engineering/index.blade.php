@extends('layouts.app')

@section('title', 'Feature Engineering')

@section('content')

<x-ui.page-header
    title="Feature Engineering"
    description="Generated machine learning feature snapshots."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total"
            :value="$dashboard->statistics['total']"
            description="Generated feature snapshots"
        >
            <x-slot:icon>⚙️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Today"
            :value="$dashboard->statistics['today']"
            description="Generated today"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Pending Prediction"
            :value="$dashboard->statistics['pending_prediction']"
            description="Waiting for prediction"
        >
            <x-slot:icon>⏳</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Processed"
            :value="$dashboard->statistics['processed_prediction']"
            description="Prediction completed"
        >
            <x-slot:icon>✅</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Feature Snapshots
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