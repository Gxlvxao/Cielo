<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cielo') }} - Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|playfair-display:400,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c9a35e; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #b08d4b; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-cielo-dark selection:bg-cielo-terracotta selection:text-white">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50 overflow-hidden">

        {{-- SIDEBAR PRIVADA (ADMIN/CLIENT) --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col shadow-2xl border-r border-white/10">
            
            <div class="h-20 flex items-center justify-center border-b border-white/10 bg-gray-900">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-cielo-terracotta rounded-full flex items-center justify-center text-white font-serif font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                        C
                    </div>
                    <span class="font-serif font-bold text-xl tracking-wider text-white">CIELO</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                @auth
                    @if(Auth::user()->isAdmin())
                        {{-- MENU ADMINISTRADOR --}}
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">Administration</p>

                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            {{-- Icon Overview --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            {{ __('Overview') }}
                        </a>
                        
                        {{-- Links Admin adicionais aqui (Requests, Wallets, etc) copiados do seu arquivo anterior --}}
                        <a href="{{ route('admin.access-requests') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.access-requests') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                             <span>{{ __('Requests') }}</span>
                        </a>

                        <a href="{{ route('admin.properties.pending') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.properties.pending') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <span>{{ __('Moderation') }}</span>
                       </a>

                    @else
                        {{-- MENU CLIENTE / DEVELOPER --}}
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">Client Area</p>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ __('My Investments') }}
                        </a>

                        @can('manageProperties', App\Models\User::class)
                            <a href="{{ route('properties.my') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white">
                                {{ __('My Properties') }}
                            </a>
                        @endcan
                    @endif
                @endauth
            </nav>

            {{-- PROFILE FOOTER --}}
            <div class="border-t border-white/10 bg-gray-900/50 p-4">
                @auth
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-cielo-terracotta flex items-center justify-center text-white font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-white/5 hover:bg-red-500/20 hover:text-red-400 rounded-lg transition-all">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <header class="bg-white shadow-sm lg:hidden flex items-center justify-between p-4 z-40">
                <button @click="sidebarOpen = true" class="text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <span class="font-serif font-bold text-lg text-cielo-dark">CIELO DASHBOARD</span>
            </header>

            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-transition.opacity></div>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @if (isset($header))
                    <div class="mb-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            {{ $header }}
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>