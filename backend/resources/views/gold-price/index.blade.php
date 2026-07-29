@extends('layouts.app')

@section('title', 'Gold Prices')

@section('content')

<x-ui.page-header
    title="Gold Prices"
    description="Historical gold price data collected from Yahoo Finance."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="3">

        <x-ui.stat-card
            title="Latest Price"
            :value="number_format($dashboard->latestPrice?->closePrice ?? 0, 2)"
            description="Latest closing price"
        >
            <x-slot:icon>💰</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Latest Date"
            :value="$dashboard->latestDate?->format('Y-m-d') ?? '-'"
            description="Most recent trading day"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Records"
            :value="$dashboard->table->rows->total()"
            description="Total records"
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
                    Gold Price History
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