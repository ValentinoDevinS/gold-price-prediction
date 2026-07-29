@extends('layouts.app')

@section('title', 'Clean Article')

@section('content')

<x-ui.page-header
    title="Clean Article"
    description="View preprocessing result."
>

    <x-slot:actions>

        <a
            href="{{ route('clean-articles.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

    </x-slot:actions>

</x-ui.page-header>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Original Content
            </h2>

        </x-slot:header>

        <div class="whitespace-pre-line text-sm">

            {{ $cleanArticle->originalContent }}

        </div>

    </x-ui.card>

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Cleaned Content
            </h2>

        </x-slot:header>

        <div class="whitespace-pre-line text-sm">

            {{ $cleanArticle->cleanContent }}

        </div>

    </x-ui.card>

</div>

<div class="mt-6">

    <x-ui.card>

        <x-slot:header>

            <h2 class="text-lg font-semibold">
                Processing Information
            </h2>

        </x-slot:header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

            <div>

                <div class="text-sm text-gray-500">
                    Source
                </div>

                <div>
                    {{ $cleanArticle->articleSource }}
                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">
                    Language
                </div>

                <div>
                    {{ $cleanArticle->language }}
                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">
                    Original Words
                </div>

                <div>
                    {{ number_format($cleanArticle->originalWordCount) }}
                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">
                    Clean Words
                </div>

                <div>
                    {{ number_format($cleanArticle->cleanWordCount) }}
                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">
                    Cleaner Version
                </div>

                <div>
                    {{ $cleanArticle->cleanerVersion }}
                </div>

            </div>

            <div>

                <div class="text-sm text-gray-500">
                    Cleaned At
                </div>

                <div>
                    {{ $cleanArticle->cleanedAt?->format('Y-m-d H:i:s') }}
                </div>

            </div>

        </div>

    </x-ui.card>

</div>

@endsection