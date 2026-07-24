@extends('layouts.app')

@section('title', 'Sentiment Analysis')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Sentiment Analysis"
        description="Browse sentiment analysis results generated from cleaned articles."
    >

        <x-slot:actions>

            <a
                href="{{ route('clean-articles.index') }}"
                class="btn btn-secondary"
            >
                Back to Clean Articles
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    {{-- Statistics --}}
    @include('sentiment-analyses.sections.statistics')

    {{-- Filters --}}
    @include('sentiment-analyses.sections.filters')

    {{-- Table --}}
    @include('sentiment-analyses.sections.table')

</x-ui.stack>

@endsection