@extends('layouts.app')

@section('title', 'System Logs')

@section('content')

<x-ui.page-header
    title="System Logs"
    description="Monitor application events, pipeline execution, and system errors."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="6">

        <x-ui.stat-card
            title="Total Logs"
            :value="number_format($dashboard->totalLogs)"
            description="All recorded logs"
        >
            <x-slot:icon>📄</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Today's Logs"
            :value="number_format($dashboard->todayLogs)"
            description="Generated today"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Info"
            :value="number_format($dashboard->infoLogs)"
            description="Informational logs"
        >
            <x-slot:icon>ℹ️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Warnings"
            :value="number_format($dashboard->warningLogs)"
            description="Require attention"
        >
            <x-slot:icon>⚠️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Errors"
            :value="number_format($dashboard->errorLogs)"
            description="Processing failures"
        >
            <x-slot:icon>❌</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Critical"
            :value="number_format($dashboard->criticalLogs)"
            description="Critical failures"
        >
            <x-slot:icon>🚨</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">

                    System Log History

                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >

                    {{ $dashboard->table->rows->total() }} Logs

                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table
            :table="$dashboard->table"
        />

    </x-ui.card>

</div>

@endsection