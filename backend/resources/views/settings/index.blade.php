@extends('layouts.app')

@section('title', 'Settings')

@section('content')

<x-ui.page-header
    title="System Settings"
    description="Configure application settings and prediction behavior."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Settings"
            :value="number_format($dashboard['statistics']['total_settings'])"
            description="Registered settings"
        >
            <x-slot:icon>⚙️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Editable"
            :value="number_format($dashboard['statistics']['editable'])"
            description="Can be modified"
        >
            <x-slot:icon>✏️</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Read Only"
            :value="number_format($dashboard['statistics']['readonly'])"
            description="Protected settings"
        >
            <x-slot:icon>🔒</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Categories"
            :value="number_format($dashboard['statistics']['categories'])"
            description="Setting groups"
        >
            <x-slot:icon>📂</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    System Settings
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