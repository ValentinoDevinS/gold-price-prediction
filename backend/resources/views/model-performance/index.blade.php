@extends('layouts.app')

@section('title', 'Model Performance')

@section('content')

<x-ui.page-header
    title="Model Performance"
    description="Compare machine learning model performance."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Best RMSE"
            :value="$dashboard->bestRmseModel"
            description="{{ number_format($dashboard->bestRmse,4) }}"
        >
            <x-slot:icon>🏆</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Best MAE"
            :value="$dashboard->bestMaeModel"
            description="{{ number_format($dashboard->bestMae,4) }}"
        >
            <x-slot:icon>📏</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Best MAPE"
            :value="$dashboard->bestMapeModel"
            description="{{ number_format($dashboard->bestMape,2) }}%"
        >
            <x-slot:icon>📉</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Best R²"
            :value="$dashboard->bestR2Model"
            description="{{ number_format($dashboard->bestR2,4) }}"
        >
            <x-slot:icon>📈</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

<x-ui.card>

<x-slot:header>

<div class="flex items-center justify-between">

<h2 class="text-lg font-semibold">

Model Comparison

</h2>

<x-ui.badge
:variant="\App\Enums\Ui\BadgeVariant::Info"
>

4 Models

</x-ui.badge>

</div>

</x-slot:header>

<x-ui.table
    :table="$dashboard->table"
/>

</x-ui.card>

</div>

@endsection