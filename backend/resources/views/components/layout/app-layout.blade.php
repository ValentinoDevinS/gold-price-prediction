<div>
    <!-- Be present above all else. - Naval Ravikant -->
</div><!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-background text-text">

    <div class="flex min-h-screen">

        <x-layout.sidebar />

        <div class="flex flex-1 flex-col">

            <x-layout.topbar />

            <main class="flex-1 overflow-y-auto p-lg">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>