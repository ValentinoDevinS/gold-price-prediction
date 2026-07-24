@extends('layouts.app')

@section('title', 'Full Articles')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Full Articles"
        description="Browse downloaded articles before the cleaning process."
    >

        <x-slot:actions>

            <a
                href="{{ route('articles.index') }}"
                class="btn btn-secondary"
            >
                Back to Articles
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    {{-- Statistics --}}
    @include('full-articles.sections.statistics')

    {{-- Filters --}}
    @include('full-articles.sections.filters')

    {{-- Table --}}
    @include('full-articles.sections.table')

</x-ui.stack>

@endsection