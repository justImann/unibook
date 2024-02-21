<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-button label="Unibook Store" link="/" icon="o-sparkles" class="text-xl btn-ghost" />        
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="p-2 pt-4 pl-4">
                <x-button label="Unibook Store" link="/" icon="o-sparkles" class="text-xl btn-ghost" />
            </div>


            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-list-item :item="$user" sub-value="username" no-separator no-hover class="!-mx-2 mt-2 mb-5 border-y border-y-sky-900">
                        <x-slot:actions>
                            @livewire('logout-button')
                        </x-slot:actions>
                    </x-list-item>
                @else
                
                <x-card class="!p-2 mb-2 bg-warning">
                        <x-alert title="Kamu belum login!" icon="o-exclamation-triangle" class="alert-warning mb-2"/>
                        <x-menu-item title="Login" icon="o-user" link="/login" />
                        <x-menu-item title="Register" icon="o-plus" link="/register" />        
                    </x-card>
                @endif
                <x-menu-item title="Home" icon="o-sparkles" link="/" />
                <div class="relative">
                    @unless ($user = auth()->user())
                        <div class="absolute top-0 left-0 w-full h-full z-10 bg-gray-50/50 dark:bg-gray-900/50 rounded"></div>
                    @endunless
                    <x-menu-item title="Admin" icon="o-users" link="/admin" class="" />
                    <x-menu-item title="Pengadaan" icon="o-clipboard-document-list" link="/sourcing"  class="" />
                </div>
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
