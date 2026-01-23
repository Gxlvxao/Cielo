<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cielo') }} - Portal</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('images/hero.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/hero.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|playfair-display:400,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        /* Scrollbar fina e moderna */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c9a35e; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #b08d4b; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-cielo-dark selection:bg-cielo-terracotta selection:text-white">
    
    {{-- LAYOUT WRAPPER (SIDEBAR + CONTENT) --}}
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50 overflow-hidden">

        {{-- SIDEBAR LATERAL (DESKTOP + MOBILE DRAWER) --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col shadow-2xl border-r border-white/10">
            
            {{-- LOGO CIELO NA SIDEBAR --}}
            <div class="h-20 flex items-center justify-center border-b border-white/10 bg-gray-900">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-cielo-terracotta rounded-full flex items-center justify-center text-white font-serif font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                        C
                    </div>
                    <span class="font-serif font-bold text-xl tracking-wider text-white">
                        CIELO
                    </span>
                </a>
            </div>

            {{-- MENU LINKS --}}
            <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                
                @auth
                    @if(Auth::user()->isAdmin())
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">Administration</p>

                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            {{ __('Overview') }}
                        </a>

                        <a href="{{ route('admin.access-requests') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.access-requests') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                {{ __('Requests') }}
                            </div>
                            @php $pendingCount = \App\Models\AccessRequest::where('status', 'pending')->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="bg-white text-cielo-terracotta text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.exclusive-requests') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.exclusive-requests') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                {{ __('Wallets') }}
                            </div>
                            @php $exclusivePending = \App\Models\User::whereNotNull('developer_id')->where('status', 'pending')->count(); @endphp
                            @if($exclusivePending > 0)
                                <span class="bg-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $exclusivePending }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.properties.pending') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.properties.pending') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ __('Moderation') }}
                            </div>
                            @php $pendingProps = \App\Models\Property::where('status', 'pending_review')->count(); @endphp
                            @if($pendingProps > 0)
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingProps }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.posts.*') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            {{ __('Jornal') }}
                        </a>

                    @else
                        {{-- CLIENT / DEVELOPER MENU --}}
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">Menu</p>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ __('My Investments') }}
                        </a>

                        @can('manageProperties', App\Models\User::class)
                            <a href="{{ route('properties.my') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('properties.my') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                {{ __('My Properties') }}
                            </a>
                            <a href="{{ route('developer.clients') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('developer.clients') ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ __('My Clients') }}
                            </a>
                        @endcan
                    @endif
                @else
                    {{-- GUEST --}}
                    <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Log in
                    </a>
                @endauth

                {{-- LINKS PÚBLICOS SEMPRE VISÍVEIS --}}
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-4">Platform</p>
                
                <a href="{{ route('properties.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    {{ __('Properties') }}
                </a>
                <a href="{{ route('blog.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    {{ __('Journal') }}
                </a>
            </nav>

            {{-- USER PROFILE BOTTOM --}}
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('pages.contact') }}" class="block w-full text-center px-4 py-2 bg-cielo-terracotta text-white rounded-lg font-bold text-sm hover:bg-white hover:text-cielo-terracotta transition-colors">
                        Request Access
                    </a>
                @endauth
            </div>
        </aside>

        {{-- AREA PRINCIPAL (HEADER MOBILE + CONTEUDO) --}}
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            {{-- HEADER MOBILE (SÓ APARECE EM TELAS PEQUENAS) --}}
            <header class="bg-white shadow-sm lg:hidden flex items-center justify-between p-4 z-40">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <span class="font-serif font-bold text-lg text-cielo-dark">CIELO</span>
                </div>
                {{-- Idioma Mobile --}}
                <div class="flex items-center gap-2">
                     <a href="{{ route('language.switch', 'pt') }}" class="text-xl opacity-70 hover:opacity-100 {{ App::getLocale() == 'pt' ? 'opacity-100 scale-110' : '' }}">🇵🇹</a>
                     <a href="{{ route('language.switch', 'en') }}" class="text-xl opacity-70 hover:opacity-100 {{ App::getLocale() == 'en' ? 'opacity-100 scale-110' : '' }}">🇬🇧</a>
                </div>
            </header>

            {{-- BACKDROP PARA MOBILE --}}
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-transition.opacity></div>

            {{-- CONTEÚDO PRINCIPAL --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 scroll-smooth">
                {{-- HEADER INTERNO (TÍTULO DA PÁGINA) --}}
                @if (isset($header))
                    <div class="mb-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            {{ $header }}
                        </div>
                    </div>
                @endif

                {{ $slot }}

                {{-- FOOTER SIMPLIFICADO DENTRO DO MAIN --}}
                <footer class="mt-12 py-6 border-t border-gray-200 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} CIELO. {{ __('All rights reserved.') }}
                </footer>
            </main>

            {{-- Floating Action Buttons (MANTIDO) --}}
            <div class="fixed bottom-6 right-6 flex flex-col gap-4 z-30" x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 300)">
                {{-- Back Button --}}
                <button onclick="window.history.back()" class="w-10 h-10 bg-white text-gray-800 rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 border border-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                {{-- WhatsApp --}}
                <a href="https://wa.me/351918765491" target="_blank" class="w-12 h-12 bg-[#25D366] text-white rounded-full shadow-lg flex items-center justify-center hover:bg-[#20bd5a] hover:scale-110 transition-all">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-8.68-2.031-9.67-.272-.161-.47-.149-.734-.15-1.29 0-2.135.25-3.235.619-3.243 2.65 3.465 5.06 6.139 5.792.835 1.127 1.34 3.09 1.63 3.662.3.57.546.619.895.669.347.05 1.05.744 1.218.868.167.124.275.248.125.496-.149.248-.87 1.29-.982 1.488-.112.198-.415.223-.694.099-.272-.124-1.397-.619-2.327-1.439-1.258-1.114-2.108-2.478-2.355-2.923-.05-.248.026-.446.336-.757l.556-.706c.075-.124.037-.248-.025-.372-.062-.124-.62-1.242-1.02-1.615-.402-.375-.623-.332-.821-.332-.198 0-.463.028-.705.028-.248 0-.645.099-.97.471-.325.372-1.264 1.254-1.264 3.064 0 1.81 1.313 3.56 1.488 3.808.174.248 2.508 3.045 6.077 4.545 2.193.921 3.148.98 4.316.719 1.278-.285 2.45-1.503 2.548-2.208.099-.705.472-1.575.124-2.208z"/></svg>
                </a>
            </div>

        </div>
    </div>

    {{-- Componente de Banner de Cookies --}}
    <x-cookie-banner />
</body>
</html>