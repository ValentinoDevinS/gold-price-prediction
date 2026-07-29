@extends('layouts.app')

@section('title', 'Full Articles')

@section('content')

<x-ui.page-header
    title="Full Articles"
    description="Downloaded article contents collected by the downloader."
/>

<div class="mt-6">

    <x-ui.stat-grid :columns="4">

        <x-ui.stat-card
            title="Downloaded"
            :value="$dashboard->statistics['downloaded']"
            description="Successfully downloaded"
        >
            <x-slot:icon>📄</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Pending"
            :value="$dashboard->statistics['pending']"
            description="Waiting for download"
        >
            <x-slot:icon>⏳</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Failed"
            :value="$dashboard->statistics['failed']"
            description="Download failed"
        >
            <x-slot:icon>❌</x-slot:icon>
        </x-ui.stat-card>

        <x-ui.stat-card
            title="Words"
            :value="number_format($dashboard->statistics['total_words'])"
            description="Total downloaded words"
        >
            <x-slot:icon>📝</x-slot:icon>
        </x-ui.stat-card>

    </x-ui.stat-grid>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h2 class="text-lg font-semibold">
                    Full Articles
                </h2>

                <x-ui.badge
                    :variant="\App\Enums\Ui\BadgeVariant::Info"
                >
                    {{ $dashboard->table->rows->total() }} Records
                </x-ui.badge>

            </div>

        </x-slot:header>

        <x-ui.table :table="$dashboard->table"/>

    </x-ui.card>

</div>

@endsection