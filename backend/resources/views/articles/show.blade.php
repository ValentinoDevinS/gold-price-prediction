@extends('layouts.app')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Pipeline Explorer"
        :description="$article->title"
    >

        <x-slot:actions>

            <x-ui.button
                :href="route('articles.index')"
                variant="secondary"
            >
                ← Back to Articles
            </x-ui.button>

        </x-slot:actions>

    </x-ui.page-header>

    @include('articles.sections.pipeline')

    <x-ui.grid cols="2">

        @include('articles.sections.metadata')

        @include('articles.sections.article')

    </x-ui.grid>

    @include('articles.sections.full-article')

    @include('articles.sections.clean-article')

    @include('articles.sections.sentiment')

    @include('articles.sections.feature-snapshot')

    @include('articles.sections.prediction')

    @include('articles.sections.evaluation')

</x-ui.stack>

@endsection