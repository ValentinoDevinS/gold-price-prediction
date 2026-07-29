@extends('layouts.app')

@section('title', 'Articles')

@section('content')

<x-ui.page-header
    title="Articles"
    description="Collected news articles from various sources."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Articles"
            :value="$dashboard->statistics['total_articles']"
            description="Articles collected"
        >
            <x-slot:icon>📰</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Today's Articles"
            :value="$dashboard->statistics['today_articles']"
            description="Collected today"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Sources"
            :value="$dashboard->statistics['total_sources']"
            description="Unique news sources"
        >
            <x-slot:icon>🌐</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Latest Article"
            :value="$dashboard->latestArticle?->publishedAt?->format('Y-m-d H:i') ?? '-'"
            description="Latest publication"
        >
            <x-slot:icon>🕒</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Articles
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