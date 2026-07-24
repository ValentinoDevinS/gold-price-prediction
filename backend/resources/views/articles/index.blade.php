@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <x-ui.page-header
        title="Articles"
        description="Browse and monitor collected news articles."
    />

    @include('articles.sections.statistics')

    @include('articles.sections.filters')

    @include('articles.sections.table')

    @include('articles.sections.pagination')

</div>

@endsection