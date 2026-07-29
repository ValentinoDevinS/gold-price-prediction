@extends('layouts.app')

@section('title', 'Full Article')

@section('content')

<x-ui.page-header
    title="Full Article"
    description="Downloaded article content."
>

<x-slot:actions>

<a
    href="{{ route('full-articles.index') }}"
    class="btn btn-secondary"
>
    ← Back
</a>

</x-slot:actions>

</x-ui.page-header>

<div class="mt-6">

<x-ui.card>

<x-slot:header>

<h2 class="text-lg font-semibold">
{{ $fullArticle->article->title }}
</h2>

</x-slot:header>

<div class="space-y-6">

<div>

<h3 class="font-semibold mb-2">
Content
</h3>

<div class="prose max-w-none whitespace-pre-line">

{{ $fullArticle->content }}

</div>

</div>

<hr>

<div class="grid grid-cols-2 gap-6">

<div>

<strong>Word Count</strong>

<div>
{{ number_format($fullArticle->wordCount) }}
</div>

</div>

<div>

<strong>Downloaded At</strong>

<div>
{{ $fullArticle->downloadedAt?->format('Y-m-d H:i:s') }}
</div>

</div>

</div>

</div>

</x-ui.card>

</div>

@endsection