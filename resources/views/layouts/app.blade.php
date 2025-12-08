<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Crow Global') }} - Portal</title>

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
<body class="font-sans antialiased bg-gray-50 text-graphite selection:bg-accent selection:text-white">
    <div class="min-h-screen flex flex-col">
        
        <div class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
            <nav x-data="{ open: false, userMenu: false }" class="pointer-events-auto bg-gray-900/90 backdrop-blur-xl border border-white/10 rounded-full pl-6 pr-2 py-2 shadow-2xl flex items-center justify-between gap-6 max-w-7xl w-full transition-all hover:bg-gray-900/95">
                
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center gap-2 group">
                        <div class="w-9 h-9 bg-accent rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform">
                            C
                        </div>
                        <span class="font-heading font-bold text-lg tracking-wider text-white hidden sm:block">
                            CROW<span class="text-accent">GLOBAL</span>
                        </span>
                    </a>

                    <div class="hidden lg:flex items-center gap-1">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                {{ __('messages.overview') }}
                            </a>
                            
                            <a href="{{ route('admin.access-requests') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.access-requests') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                {{ __('messages.requests') }}
                                @php $pendingCount = \App\Models\AccessRequest::where('status', 'pending')->count(); @endphp
                                @if($pendingCount > 0)
                                    <span class="bg-yellow-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $pendingCount }}</span>
                                @endif
                            </a>

                            <a href="{{ route('admin.exclusive-requests') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.exclusive-requests') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                {{ __('messages.wallets') }}
                                @php $exclusivePending = \App\Models\User::whereNotNull('developer_id')->where('status', 'pending')->count(); @endphp
                                @if($exclusivePending > 0)
                                    <span class="bg-blue-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $exclusivePending }}</span>
                                @endif
                            </a>

                            <a href="{{ route('admin.properties.pending') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all flex items-center gap-2 {{ request()->routeIs('admin.properties.pending') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                Moderação
                                @php $pendingProps = \App\Models\Property::where('status', 'pending_review')->count(); @endphp
                                @if($pendingProps > 0)
                                    <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">{{ $pendingProps }}</span>
                                @endif
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                {{ __('messages.my_investments') }}
                            </a>
                            @can('manageProperties', App\Models\User::class)
                                <a href="{{ route('properties.my') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('properties.my') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('messages.my_properties') }}
                                </a>
                                <a href="{{ route('developer.clients') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('developer.clients') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                    {{ __('messages.my_clients') }}
                                </a>
                            @endcan
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    
                    <div class="hidden sm:flex relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-colors flex items-center gap-1">
                            <span class="text-xl leading-none">{{ App::getLocale() == 'pt' ? '🇵🇹' : '🇬🇧' }}</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 top-full mt-2 w-32 bg-white rounded-xl shadow-xl py-1 z-50 overflow-hidden">
                            <a href="{{ route('language.switch', 'pt') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex justify-between">Português <span>🇵🇹</span></a>
                            <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex justify-between">English <span>🇬🇧</span></a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="pl-1 pr-1 py-1 bg-white/5 border border-white/10 hover:bg-white/10 rounded-full flex items-center gap-3 transition-all group">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-accent to-yellow-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white mr-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 top-full mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">{{ Auth::user()->role }}</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-accent transition-colors">
                                {{ __('messages.my_profile') }}
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                    {{ __('messages.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <button @click="open = !open" class="lg:hidden p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </nav>

            <div x-show="open" x-transition class="absolute top-20 left-4 right-4 bg-gray-800 rounded-2xl border border-white/10 shadow-2xl p-4 lg:hidden pointer-events-auto">
                <div class="space-y-1">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('messages.overview') }}</a>
                        <a href="{{ route('admin.access-requests') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('messages.requests') }}</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white font-medium">{{ __('messages.dashboard') }}</a>
                    @endif
                </div>
            </div>
        </div>
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
                    &copy; {{ date('Y') }} <span class="text-graphite font-bold">CROW GLOBAL</span>. {{ __('messages.rights_reserved') }}
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-accent">{{ __('messages.support') }}</a>
                    <a href="#" class="hover:text-accent">{{ __('messages.privacy') }}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>