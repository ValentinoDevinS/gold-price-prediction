@props([

    'title' => null,

    'description' => null,

])

<x-ui.stack>

    @if($title)

        <x-ui.page-header
            :title="$title"
            :description="$description"
        />

    @endif

    @isset($statistics)

        {{ $statistics }}

    @endisset

    @isset($filters)

        {{ $filters }}

    @endisset

    @isset($content)

        {{ $content }}

    @endisset

</x-ui.stack>