@extends('layouts.app')

@section('title', 'Feature Snapshot')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Feature Snapshot"
        description="View the generated feature set used for machine learning prediction."
    >

        <x-slot:actions>

            <a
                href="{{ route('feature-snapshots.index') }}"
                class="btn btn-secondary"
            >
                Back to Feature Snapshots
            </a>

            <a
                href="{{ route('articles.show', $feature->sentimentAnalysis->cleanArticle->fullArticle->article->uuid) }}"
                class="btn btn-primary"
            >
                View Pipeline
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    @include('feature-snapshots.sections.metadata')

    @include('feature-snapshots.sections.sentiment-features')

    @include('feature-snapshots.sections.article-features')

    @include('feature-snapshots.sections.rolling-features')

    @include('feature-snapshots.sections.time-features')

    @include('feature-snapshots.sections.market-features')

</x-ui.stack>

@endsection