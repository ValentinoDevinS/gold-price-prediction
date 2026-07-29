@extends('layouts.app')

@section('title', 'Scheduler')

@section('content')

<x-ui.page-header
    title="Scheduler"
    description="Manage automatic pipeline execution."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="6">

        <x-ui.stat-card
            title="Status"
            :value="$dashboard->status"
            description="Scheduler state"
        >
            <x-slot:icon>🟢</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Next Run"
            :value="$dashboard->nextRun?->format('Y-m-d H:i')"
            description="Scheduled execution"
        >
            <x-slot:icon>⏭️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Last Run"
            :value="$dashboard->lastRun?->format('Y-m-d H:i')"
            description="Previous execution"
        >
            <x-slot:icon>⏮️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Frequency"
            :value="$dashboard->frequency"
            description="Current schedule"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Timezone"
            :value="$dashboard->timezone"
            description="Execution timezone"
        >
            <x-slot:icon>🌏</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Average Runtime"
            :value="$dashboard->averageRuntime"
            description="Minutes"
        >
            <x-slot:icon>⏱️</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

<x-ui.card>

<x-slot:header>

<div class="flex items-center justify-between">

<h2 class="text-lg font-semibold">

Scheduler Configuration

</h2>

</div>

</x-slot:header>

<x-ui.table
    :table="$dashboard->table"
/>

</x-ui.card>

</div>

@endsection