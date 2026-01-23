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
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111827; }
        ::-webkit-scrollbar-thumb { background: #c9a35e; border-radius: 3px; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-cielo-dark">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50 overflow-hidden">

        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col shadow-2xl border-r border-white/5">
            
            {{-- LOGO --}}
            <div class="h-20 flex items-center justify-center border-b border-white/10 bg-gray-950">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-cielo-terracotta rounded-full flex items-center justify-center text-white font-serif font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">C</div>
                    <span class="font-serif font-bold text-xl tracking-wider text-white">CIELO</span>
                </a>
            </div>

            {{-- MENU --}}
            <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                
                @auth
                    {{-- ========================================== --}}
                    {{-- PERFIL: ADMINISTRADOR --}}
                    {{-- ========================================== --}}
                    @if(Auth::user()->role === 'admin')
                        <p class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 mt-2">Administração</p>

                        <x-nav-link-sidebar :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="home">
                            Visão Geral
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('admin.access-requests')" :active="request()->routeIs('admin.access-requests')" icon="users">
                            Solicitações de Acesso
                            @php $reqCount = \App\Models\AccessRequest::where('status', 'pending')->count(); @endphp
                            @if($reqCount > 0)
                                <span class="ml-auto bg-cielo-terracotta text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $reqCount }}</span>
                            @endif
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('admin.exclusive-requests')" :active="request()->routeIs('admin.exclusive-requests')" icon="wallet">
                            Carteiras / Wallets
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('admin.properties.pending')" :active="request()->routeIs('admin.properties.*')" icon="check-badge">
                            Moderação de Imóveis
                            @php $propCount = \App\Models\Property::where('status', 'pending_review')->count(); @endphp
                            @if($propCount > 0)
                                <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $propCount }}</span>
                            @endif
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')" icon="newspaper">
                            Blog / Jornal
                        </x-nav-link-sidebar>
                    @endif

                    {{-- ========================================== --}}
                    {{-- PERFIL: DEVELOPER (Parceiro) --}}
                    {{-- ========================================== --}}
                    @if(Auth::user()->role === 'developer')
                        <p class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 mt-4">Área do Parceiro</p>

                        <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="chart-bar">
                            Painel de Vendas
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('properties.my')" :active="request()->routeIs('properties.my') || request()->routeIs('properties.create')" icon="building-office">
                            Meus Imóveis
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('developer.clients')" :active="request()->routeIs('developer.clients')" icon="user-group">
                            Meus Clientes (Leads)
                        </x-nav-link-sidebar>
                    @endif

                    {{-- ========================================== --}}
                    {{-- PERFIL: CLIENTE (Investidor) --}}
                    {{-- ========================================== --}}
                    @if(Auth::user()->role === 'client')
                        <p class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 mt-4">Minha Conta</p>

                        <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
                            Meus Investimentos
                        </x-nav-link-sidebar>
                    @endif

                @endauth
            </nav>

            {{-- FOOTER --}}
            <div class="border-t border-white/10 bg-gray-950 p-4">
                @auth
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-cielo-terracotta flex items-center justify-center text-white font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-white/10 hover:bg-red-500/80 hover:text-white rounded-lg transition-all uppercase tracking-wide">
                            Sair
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        {{-- CONTEÚDO PRINCIPAL --}}
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