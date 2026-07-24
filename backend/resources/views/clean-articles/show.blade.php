@extends('layouts.app')

@section('title', 'Clean Article')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Clean Article"
        description="View the cleaned article after the preprocessing stage."
    >

        <x-slot:actions>

            <a
                href="{{ route('clean-articles.index') }}"
                class="btn btn-secondary"
            >
                Back to Clean Articles
            </a>

            <a
                href="{{ route('articles.show', $cleanArticle->fullArticle->article->uuid) }}"
                class="btn btn-primary"
            >
                View Pipeline
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    @include('clean-articles.sections.metadata')

    @include('clean-articles.sections.content')

</x-ui.stack>

@endsection