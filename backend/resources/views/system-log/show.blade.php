@extends('layouts.app')

@section('title','Log Detail')

@section('content')

<x-ui.page-header
    title="Log Detail"
    description="Detailed information for a system log."
>

<x-slot:actions>

<a
    href="{{ route('system-log.index') }}"
    class="btn btn-secondary"
>

← Back

</a>

</x-slot:actions>

</x-ui.page-header>

<div class="mt-6 space-y-6">

<x-ui.card>

<x-slot:header>

General Information

</x-slot:header>

<div class="grid grid-cols-2 gap-6">

<div>

<strong>Timestamp</strong>

<p>{{ $log->createdAt }}</p>

</div>

<div>

<strong>Level</strong>

<x-ui.badge
:variant="$log->levelBadge"
>

{{ $log->level }}

</x-ui.badge>

</div>

<div>

<strong>Module</strong>

<p>{{ $log->module }}</p>

</div>

<div>

<strong>Status</strong>

<p>{{ $log->status }}</p>

</div>

<div>

<strong>Execution Time</strong>

<p>{{ $log->duration }} ms</p>

</div>

<div>

<strong>Pipeline Run</strong>

<p>{{ $log->pipelineRunId }}</p>

</div>

</div>

</x-ui.card>

<x-ui.card>

<x-slot:header>

Message

</x-slot:header>

<div class="prose max-w-none">

{{ $log->message }}

</div>

</x-ui.card>

<x-ui.card>

<x-slot:header>

Additional Information

</x-slot:header>

<pre class="overflow-auto rounded bg-gray-100 p-4 text-sm">

{{ json_encode($log->context, JSON_PRETTY_PRINT) }}

</pre>

</x-ui.card>

@if($log->stackTrace)

<x-ui.card>

<x-slot:header>

Stack Trace

</x-slot:header>

<pre class="overflow-auto rounded bg-red-50 p-4 text-xs">

{{ $log->stackTrace }}

</pre>

</x-ui.card>

@endif

</div>

@endsection