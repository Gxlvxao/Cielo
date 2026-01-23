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
    <div class="min-h-screen flex flex-col">
        
        {{-- MENU FLUTUANTE (LAYOUT PÚBLICO) --}}
        <div class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
            <nav x-data="{ open: false, userMenu: false }" class="pointer-events-auto bg-gray-900/90 backdrop-blur-xl border border-white/10 rounded-full pl-6 pr-2 py-2 shadow-2xl flex items-center justify-between gap-6 max-w-7xl w-full transition-all hover:bg-gray-900/95">
                
                <div class="flex items-center gap-8">
                    {{-- LOGO CIELO --}}
                    <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2 group">
                        <div class="w-9 h-9 bg-cielo-terracotta rounded-full flex items-center justify-center text-white font-serif font-bold text-lg shadow-lg group-hover:scale-110 transition-transform">
                            C
                        </div>
                        <span class="font-serif font-bold text-lg tracking-wider text-white hidden sm:block">
                            CIELO
                        </span>
                    </a>

                    {{-- MENU USUÁRIO / ADMIN --}}
                    <div class="hidden lg:flex items-center gap-1">
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Overview') }}
                                </a>
                                
                                <a href="{{ route('admin.access-requests') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.access-requests') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Requests') }}
                                    @php $pendingCount = \App\Models\AccessRequest::where('status', 'pending')->count(); @endphp
                                    @if($pendingCount > 0)
                                        <span class="bg-yellow-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $pendingCount }}</span>
                                    @endif
                                </a>

                                <a href="{{ route('admin.exclusive-requests') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.exclusive-requests') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Wallets') }}
                                    @php $exclusivePending = \App\Models\User::whereNotNull('developer_id')->where('status', 'pending')->count(); @endphp
                                    @if($exclusivePending > 0)
                                        <span class="bg-blue-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $exclusivePending }}</span>
                                    @endif
                                </a>

                                <a href="{{ route('admin.properties.pending') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.properties.pending') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Moderation') }}
                                    @php $pendingProps = \App\Models\Property::where('status', 'pending_review')->count(); @endphp
                                    @if($pendingProps > 0)
                                        <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $pendingProps }}</span>
                                    @endif
                                </a>

                                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('admin.posts.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Jornal') }}
                                </a>

                            @else
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('My Investments') }}
                                </a>
                                @can('manageProperties', App\Models\User::class)
                                    <a href="{{ route('properties.my') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('properties.my') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                        {{ __('My Properties') }}
                                    </a>
                                    <a href="{{ route('developer.clients') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('developer.clients') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                        {{ __('My Clients') }}
                                    </a>
                                @endcan
                            @endif
                        @else
                            {{-- Links Públicos quando não logado --}}
                            <a href="{{ route('properties.index') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all">
                                {{ __('Properties') }}
                            </a>
                            <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all">
                                {{ __('Journal') }}
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    
                    {{-- IDIOMA --}}
                    <div class="hidden sm:flex relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-colors flex items-center gap-1">
                            <span class="text-xl leading-none">{{ App::getLocale() == 'pt' ? '🇵🇹' : (App::getLocale() == 'fr' ? '🇫🇷' : '🇬🇧') }}</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 top-full mt-2 w-32 bg-white rounded-xl shadow-xl py-1 z-50 overflow-hidden">
                            <a href="{{ route('language.switch', 'pt') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex justify-between">Português <span>🇵🇹</span></a>
                            <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex justify-between">English <span>🇬🇧</span></a>
                            <a href="{{ route('language.switch', 'fr') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex justify-between">Français <span>🇫🇷</span></a>
                        </div>
                    </div>

                    {{-- USER DROPDOWN --}}
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="pl-1 pr-1 py-1 bg-white/5 border border-white/10 hover:bg-white/10 rounded-full flex items-center gap-3 transition-all group">
                                <div class="w-8 h-8 rounded-full bg-cielo-terracotta flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-white mr-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="open" 
                                 x-transition
                                 class="absolute right-0 top-full mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">{{ Auth::user()->role }}</p>
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-cielo-terracotta transition-colors">
                                    {{ __('My Profile') }}
                                </a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-200 hover:text-white px-2">Log in</a>
                        <a href="{{ route('pages.contact') }}" class="bg-cielo-terracotta text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg hover:bg-white hover:text-cielo-terracotta transition-all">Request Access</a>
                    @endauth

                    <button @click="open = !open" class="lg:hidden p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </nav>

            {{-- MOBILE MENU --}}
            <div x-show="open" x-transition class="absolute top-20 left-4 right-4 bg-gray-800 rounded-2xl border border-white/10 shadow-2xl p-4 lg:hidden pointer-events-auto">
                <div class="space-y-1">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Overview') }}</a>
                            <a href="{{ route('admin.access-requests') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Requests') }}</a>
                            <a href="{{ route('admin.exclusive-requests') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Wallets') }}</a>
                            <a href="{{ route('admin.properties.pending') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Moderation') }}</a>
                            <a href="{{ route('admin.posts.index') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Jornal') }}</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('Dashboard') }}</a>
                        @endif
                    @else
                        <a href="{{ route('properties.index') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:text-white">{{ __('Properties') }}</a>
                        <a href="{{ route('pages.about') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:text-white">{{ __('About') }}</a>
                        <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:text-white">{{ __('Journal') }}</a>
                        <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:text-white">{{ __('Log in') }}</a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- ESPAÇAMENTO PARA O HEADER FIXO --}}
        @if (isset($header))
            <div class="mt-28">
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            </div>
        @else
            <div class="mt-24"></div>
        @endif

        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <div class="mb-2 md:mb-0">
                    &copy; {{ date('Y') }} <span class="text-cielo-dark font-bold font-serif">CIELO</span>. {{ __('All rights reserved.') }}
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-cielo-terracotta">{{ __('Support') }}</a>
                    <a href="{{ route('legal.privacy') }}" class="hover:text-cielo-terracotta">{{ __('Privacy Policy') }}</a>
                </div>
            </div>
        </footer>
    </div>

    {{-- Floating Action Buttons --}}
    <div class="fixed bottom-6 right-6 flex flex-col gap-4 z-40" x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 300)">
        
        {{-- Back Button --}}
        <button onclick="window.history.back()" 
                class="w-12 h-12 bg-white text-gray-800 rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 hover:scale-110 transition-all duration-300 border border-gray-200"
                title="{{ __('Go Back') }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </button>

        {{-- WhatsApp Button --}}
        <a href="https://wa.me/351918765491" target="_blank" 
           class="w-12 h-12 bg-[#25D366] text-white rounded-full shadow-lg flex items-center justify-center hover:bg-[#20bd5a] hover:scale-110 transition-all duration-300"
           title="WhatsApp">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-8.68-2.031-9.67-.272-.161-.47-.149-.734-.15-1.29 0-2.135.25-3.235.619-3.243 2.65 3.465 5.06 6.139 5.792.835 1.127 1.34 3.09 1.63 3.662.3.57.546.619.895.669.347.05 1.05.744 1.218.868.167.124.275.248.125.496-.149.248-.87 1.29-.982 1.488-.112.198-.415.223-.694.099-.272-.124-1.397-.619-2.327-1.439-1.258-1.114-2.108-2.478-2.355-2.923-.05-.248.026-.446.336-.757l.556-.706c.075-.124.037-.248-.025-.372-.062-.124-.62-1.242-1.02-1.615-.402-.375-.623-.332-.821-.332-.198 0-.463.028-.705.028-.248 0-.645.099-.97.471-.325.372-1.264 1.254-1.264 3.064 0 1.81 1.313 3.56 1.488 3.808.174.248 2.508 3.045 6.077 4.545 2.193.921 3.148.98 4.316.719 1.278-.285 2.45-1.503 2.548-2.208.099-.705.472-1.575.124-2.208z"/>
            </svg>
        </a>

        {{-- Scroll to Top Button --}}
        <button x-show="showTop" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="w-12 h-12 bg-cielo-terracotta text-white rounded-full shadow-lg flex items-center justify-center hover:bg-cielo-terracotta/90 hover:scale-110 transition-all duration-300"
                title="{{ __('Back to Top') }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </div>

    <x-cookie-banner />
</body>
</html>