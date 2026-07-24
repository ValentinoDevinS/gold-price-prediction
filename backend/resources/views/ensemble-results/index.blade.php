@extends('layouts.app')

@section('title', 'Ensemble Results')

@section('content')

<div class="container mx-auto px-4 py-6">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-2xl font-bold">
                Ensemble Results
            </h1>

            <p class="text-gray-500 mt-1">
                View generated ensemble prediction results from multiple AI models.
            </p>

        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('dashboard') }}"
                class="btn btn-secondary"
            >
                Back
            </a>

        </div>

    </div>

    @include('ensemble-results.sections.statistics')

    <div class="mt-6">
        @include('ensemble-results.sections.filters')
    </div>

    <div class="mt-6">
        @include('ensemble-results.sections.table')
    </div>

</div>

@endsection