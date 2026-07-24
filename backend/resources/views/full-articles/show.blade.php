@extends('layouts.app')

@section('title', 'Full Article')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Full Article"
        description="View the downloaded article before the cleaning process."
    >

        <x-slot:actions>

            <a
                href="{{ route('full-articles.index') }}"
                class="btn btn-secondary"
            >
                Back to Full Articles
            </a>

            <a
                href="{{ route('articles.show', $fullArticle->article->uuid) }}"
                class="btn btn-primary"
            >
                View Pipeline
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    @include('full-articles.sections.metadata')

    @include('full-articles.sections.content')

</x-ui.stack>

@endsection