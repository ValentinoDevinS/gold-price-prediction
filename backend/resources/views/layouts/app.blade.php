<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>

        {{ config('app.name') }}

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

</head>

<body class="bg-gray-100 dark:bg-gray-950">

<div class="flex h-screen">

    <x-layout.sidebar>

        <x-slot:header>

            <x-layout.application-logo/>

        </x-slot:header>

        <x-slot:footer>

            {{ auth()->user()->name }}

        </x-slot:footer>

    </x-layout.sidebar>

    <div class="flex flex-1 flex-col overflow-hidden">

        <x-layout.topbar>

            <x-slot:start>

                {{ $breadcrumb ?? '' }}

            </x-slot:start>

            <x-slot:end>

                {{ auth()->user()->name }}

            </x-slot:end>

        </x-layout.topbar>

        <x-layout.page-content>

            {{ $slot }}

        </x-layout.page-content>

    </div>

</div>

</body>

</html>