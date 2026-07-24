@extends('layouts.app')

@section('title', 'Sentiment Analysis')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Sentiment Analysis"
        description="View the sentiment analysis generated from the cleaned article."
    >

        <x-slot:actions>

            <a
                href="{{ route('sentiment-analyses.index') }}"
                class="btn btn-secondary"
            >
                Back to Sentiment Analysis
            </a>

            <a
                href="{{ route('articles.show', $sentiment->cleanArticle->fullArticle->article->uuid) }}"
                class="btn btn-primary"
            >
                View Pipeline
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    @include('sentiment-analyses.sections.metadata')

    @include('sentiment-analyses.sections.scores')

</x-ui.stack>

@endsection