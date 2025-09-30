<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Off-canvas + fixed sidebar -->
            <livewire:sidebar />

            <!-- Right column -->
            <div class="md:ms-64">
                <!-- Top Header: nav + breadcrumbs + account dropdown -->
                <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16">
                            <div class="flex items-center gap-3">
                                <!-- Mobile open sidebar button -->
                                <button type="button" class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100" x-data @click="$dispatch('open-sidebar')">
                                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                                    </svg>
                                </button>
                                <!-- Page title / breadcrumbs slot -->
                                <div class="hidden sm:flex flex-col">
                                    @if (isset($header))
                                        <div class="text-lg font-semibold text-gray-900">{{ $header }}</div>
                                    @else
                                        <div class="text-lg font-semibold text-gray-900">@yield('title', $pageTitle ?? 'Dashboard')</div>
                                    @endif
                                    <div class="text-sm text-gray-500">
                                        <x-breadcrumbs />
                                    </div>
                                </div>
                            </div>
                            <!-- Account dropdown and team switcher from Jetstream -->
                            <div class="sm:flex">
                                @include('navigation-menu')
                            </div>
                        </div>
                    </div>
                    <!-- Compact mobile account nav -->
                    <div class="sm:hidden border-t border-gray-100 px-6 py-2">
                        {{-- @include('navigation-menu') --}}
                        @if (isset($header))
                            <div class="text-md font-semibold text-gray-900">{{ $header }}</div>
                        @else
                            <div class="text-md font-semibold text-gray-900">@yield('title', $pageTitle ?? 'Dashboard')</div>
                        @endif
                        <div class="text-sm text-gray-500">
                            <x-breadcrumbs />
                        </div>
                    </div>
                </header>

                <!-- Main content -->
                <main class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
