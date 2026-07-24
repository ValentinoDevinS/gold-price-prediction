@extends('layouts.app')

@section('title', 'Clean Articles')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Clean Articles"
        description="Browse cleaned articles after the preprocessing stage."
    >

        <x-slot:actions>

            <a
                href="{{ route('full-articles.index') }}"
                class="btn btn-secondary"
            >
                Back to Full Articles
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    {{-- Statistics --}}
    @include('clean-articles.sections.statistics')

    {{-- Filters --}}
    @include('clean-articles.sections.filters')

    {{-- Table --}}
    @include('clean-articles.sections.table')

</x-ui.stack>

@endsection