@extends('layouts.app')

@section('title', 'Training')

@section('content')

<x-ui.page-header
    title="Model Training"
    description="Registered machine learning models and training information."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Models"
            :value="$dashboard->statistics['total']"
            description="Registered models"
        >
            <x-slot:icon>🧠</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Active Models"
            :value="$dashboard->statistics['active']"
            description="Currently active"
        >
            <x-slot:icon>✅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Average Training"
            :value="$dashboard->statistics['average_training_time']"
            description="Average training time (seconds)"
        >
            <x-slot:icon>⏱️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Largest Dataset"
            :value="$dashboard->statistics['largest_dataset']"
            description="Training samples"
        >
            <x-slot:icon>📊</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Registered Models
                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >
                    {{ $dashboard->table->rows->total() }} Models
                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard->table"
        />

    </x-ui.card>

</div>

@endsection