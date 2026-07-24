@extends('layouts.app')

@section('title', 'Feature Snapshots')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Feature Snapshots"
        description="Browse generated feature snapshots used for machine learning prediction."
    >

        <x-slot:actions>

            <a
                href="{{ route('sentiment-analyses.index') }}"
                class="btn btn-secondary"
            >
                Back to Sentiment Analysis
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    {{-- Statistics --}}
    @include('feature-snapshots.sections.statistics')

    {{-- Filters --}}
    @include('feature-snapshots.sections.filters')

    {{-- Table --}}
    @include('feature-snapshots.sections.table')

</x-ui.stack>

@endsection