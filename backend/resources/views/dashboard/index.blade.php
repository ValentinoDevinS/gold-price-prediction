@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <x-ui.page-header
        title="Dashboard"
        description="Gold Price Prediction System Overview"
    />

    @include('dashboard.sections.statistics')

    @include('dashboard.sections.chart')

    @include('dashboard.sections.prediction-summary')

    @include('dashboard.sections.pipeline-status')

    {{-- @include('dashboard.sections.quick-actions') --}}
    {{-- @include('dashboard.sections.recent-activities') --}}

@endsection