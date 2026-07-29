@extends('layouts.app')

@section('title', 'Clean Articles')

@section('content')

<x-ui.page-header
    title="Clean Articles"
    description="Preprocessed articles ready for sentiment analysis."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Total Clean Articles"
            :value="number_format($dashboard['statistics']['total'])"
            description="Successfully preprocessed"
        >
            <x-slot:icon>🧹</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Cleaned Today"
            :value="number_format($dashboard['statistics']['today'])"
            description="Processed today"
        >
            <x-slot:icon>📅</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Avg Original Words"
            :value="number_format($dashboard['statistics']['average_original_words'])"
            description="Before preprocessing"
        >
            <x-slot:icon>📝</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Avg Clean Words"
            :value="number_format($dashboard['statistics']['average_clean_words'])"
            description="After preprocessing"
        >
            <x-slot:icon>✨</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Clean Articles
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