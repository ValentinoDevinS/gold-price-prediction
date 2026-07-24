@extends('layouts.app')

@section('title', 'Prediction Results')

@section('content')

<x-ui.stack>

    <x-ui.page-header
        title="Prediction Results"
        description="View machine learning prediction results generated from feature snapshots."
    >

        <x-slot:actions>

            <a
                href="{{ route('feature-snapshots.index') }}"
                class="btn btn-secondary"
            >
                Back to Feature Snapshots
            </a>

        </x-slot:actions>

    </x-ui.page-header>

    @include('prediction-results.sections.statistics')

    @include('prediction-results.sections.filters')

    @include('prediction-results.sections.table')

</x-ui.stack>

@endsection