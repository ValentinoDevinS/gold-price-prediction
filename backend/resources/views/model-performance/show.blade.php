@extends('layouts.app')

@section('title', 'Model Performance')

@section('content')

<x-ui.page-header
title="Performance Report"
description="Detailed model evaluation."
>

<x-slot:actions>

<a
href="{{ route('model-performance.index') }}"
class="btn btn-secondary"
>

← Back

</a>

</x-slot:actions>

</x-ui.page-header>

<div class="mt-6">

<x-ui.card>

<x-slot:header>

Performance Summary

</x-slot:header>

<table class="min-w-full text-sm">

<thead>

<tr>

<th>Metric</th>

<th>LSTM</th>

<th>CNN</th>

<th>ANN</th>

<th>Ensemble</th>

<th>Best</th>

</tr>

</thead>

<tbody>

<tr>

<td>RMSE</td>

<td>{{ $performance->lstmRmse }}</td>

<td>{{ $performance->cnnRmse }}</td>

<td>{{ $performance->annRmse }}</td>

<td>{{ $performance->ensembleRmse }}</td>

<td>{{ $performance->bestRmseModel }}</td>

</tr>

<tr>

<td>MAE</td>

<td>{{ $performance->lstmMae }}</td>

<td>{{ $performance->cnnMae }}</td>

<td>{{ $performance->annMae }}</td>

<td>{{ $performance->ensembleMae }}</td>

<td>{{ $performance->bestMaeModel }}</td>

</tr>

<tr>

<td>MAPE</td>

<td>{{ $performance->lstmMape }}</td>

<td>{{ $performance->cnnMape }}</td>

<td>{{ $performance->annMape }}</td>

<td>{{ $performance->ensembleMape }}</td>

<td>{{ $performance->bestMapeModel }}</td>

</tr>

<tr>

<td>R²</td>

<td>{{ $performance->lstmR2 }}</td>

<td>{{ $performance->cnnR2 }}</td>

<td>{{ $performance->annR2 }}</td>

<td>{{ $performance->ensembleR2 }}</td>

<td>{{ $performance->bestR2Model }}</td>

</tr>

</tbody>

</table>

</x-ui.card>

</div>

@endsection