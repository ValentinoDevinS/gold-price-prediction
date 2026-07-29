@extends('layouts.app')

@section('title', 'Article Details')

@section('content')

<x-ui.page-header
    title="Article Details"
    description="View article metadata and scraping information."
>

    <x-slot:actions>

        <a
            href="{{ route('articles.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

    </x-slot:actions>

</x-ui.page-header>

<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2">

        <x-ui.card>

            <x-slot:header>

                <h2 class="text-lg font-semibold">
                    {{ $article->title }}
                </h2>

            </x-slot:header>

            <div class="space-y-5">

                <div>

                    <div class="text-sm text-gray-500">
                        Source
                    </div>

                    <div class="font-medium">
                        {{ $article->source }}
                    </div>

                </div>

                <div>

                    <div class="text-sm text-gray-500">
                        URL
                    </div>

                    <a
                        href="{{ $article->url }}"
                        target="_blank"
                        class="text-blue-600 hover:underline break-all"
                    >
                        {{ $article->url }}
                    </a>

                </div>

                <div>

                    <div class="text-sm text-gray-500">
                        Published At
                    </div>

                    <div>
                        {{ $article->publishedAt?->format('Y-m-d H:i:s') }}
                    </div>

                </div>

                <div>

                    <div class="text-sm text-gray-500">
                        Keyword
                    </div>

                    <div>
                        {{ $article->keyword }}
                    </div>

                </div>

            </div>

        </x-ui.card>

    </div>

    <div>

        <x-ui.card>

            <x-slot:header>

                <h2 class="text-lg font-semibold">
                    Metadata
                </h2>

            </x-slot:header>

            <dl class="space-y-4">

                <div>

                    <dt class="text-sm text-gray-500">
                        Status
                    </dt>

                    <dd>
                        {{ $article->status->value }}
                    </dd>

                </div>

                <div>

                    <dt class="text-sm text-gray-500">
                        Language
                    </dt>

                    <dd>
                        {{ $article->language }}
                    </dd>

                </div>

                <div>

                    <dt class="text-sm text-gray-500">
                        Country
                    </dt>

                    <dd>
                        {{ $article->country }}
                    </dd>

                </div>

                <div>

                    <dt class="text-sm text-gray-500">
                        Scraper
                    </dt>

                    <dd>
                        {{ $article->scraper }}
                    </dd>

                </div>

                <div>

                    <dt class="text-sm text-gray-500">
                        Scraped At
                    </dt>

                    <dd>
                        {{ $article->scrapedAt?->format('Y-m-d H:i:s') }}
                    </dd>

                </div>

                <div>

                    <dt class="text-sm text-gray-500">
                        UUID
                    </dt>

                    <dd class="break-all text-xs">
                        {{ $article->uuid }}
                    </dd>

                </div>

            </dl>

        </x-ui.card>

    </div>

</div>

@endsection