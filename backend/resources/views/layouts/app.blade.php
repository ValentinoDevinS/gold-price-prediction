<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <x-layout.sidebar>

        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white font-bold">
                    GP
                </div>

                <div>
                    <div class="font-bold text-lg">
                        Gold Prediction
                    </div>

                    <div class="text-xs text-gray-500">
                        Decision Support System
                    </div>
                </div>
            </div>
        </x-slot:header>

    </x-layout.sidebar>

    {{-- Main Content --}}
    <div class="flex flex-1 flex-col overflow-hidden">

        {{-- Topbar --}}
        <x-layout.topbar>

            <x-slot:start>

                <div class="font-semibold text-lg">
                    @yield('title', 'Dashboard')
                </div>

            </x-slot:start>

            <x-slot:center>

            </x-slot:center>

            <x-slot:end>

                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <div class="font-medium">
                            Administrator
                        </div>

                        <div class="text-xs text-gray-500">
                            System Administrator
                        </div>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-500 text-white font-bold">
                        A
                    </div>

                </div>

            </x-slot:end>

        </x-layout.topbar>

        {{-- Page --}}
        <main class="flex-1 overflow-y-auto p-6">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>