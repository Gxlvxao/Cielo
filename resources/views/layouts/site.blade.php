<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cielo') }} - {{ $title ?? 'Luxury Real Estate' }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .menu-backdrop { backdrop-filter: blur(12px); }
    </style>
</head>
<body class="font-sans text-cielo-dark bg-cielo-cream antialiased selection:bg-cielo-terracotta selection:text-white" 
      x-data="{ menuOpen: false }">

    {{-- 1. RAIL SIDEBAR (Só Desktop - A classe hidden já está no componente) --}}
    <x-cielo.sidebar-rail />

    {{-- 2. MOBILE HEADER (Só Mobile - md:hidden) --}}
    {{-- Substitui a sidebar no celular para ganhar espaço --}}
    <div class="fixed top-0 left-0 w-full h-16 bg-cielo-dark/90 backdrop-blur-md z-50 flex items-center justify-between px-6 md:hidden border-b border-white/10 transition-all duration-300">
        {{-- Logo Simples --}}
        <a href="{{ route('home') }}" class="font-display text-2xl text-white tracking-widest uppercase">
            Cielo
        </a>
        
        {{-- Trigger do Menu (Hamburguer Simples) --}}
        <button @click="menuOpen = true" class="text-white p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    {{-- 3. MENU OVERLAY (Tela Cheia) --}}
    <div x-cloak 
         x-show="menuOpen" 
         @toggle-menu.window="menuOpen = !menuOpen"
         class="fixed inset-0 z-[60] flex justify-end items-stretch">
        
        {{-- Backdrop Escuro --}}
        <div @click="menuOpen = false"
             x-show="menuOpen"
             x-transition:enter="transition opacity duration-500"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-cielo-dark/90 menu-backdrop cursor-pointer"></div>

        {{-- Painel do Menu --}}
        <div x-show="menuOpen"
             x-transition:enter="transition transform duration-500 cubic-bezier(0.16, 1, 0.3, 1)"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform duration-500 cubic-bezier(0.16, 1, 0.3, 1)"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="relative w-full md:w-[600px] h-full bg-cielo-cream text-cielo-dark shadow-2xl overflow-y-auto flex flex-col">
            
            {{-- Botão Fechar --}}
            <button @click="menuOpen = false" class="absolute top-6 right-6 p-2 hover:rotate-90 transition duration-300 z-50 text-cielo-dark hover:text-cielo-terracotta">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            {{-- Conteúdo do Menu --}}
            <div class="p-8 md:p-12 flex flex-col h-full justify-between mt-12 md:mt-0">
                
                {{-- Topo: Login e Idioma --}}
                <div class="flex flex-wrap gap-8 items-center text-xs font-bold tracking-widest uppercase text-cielo-navy/60">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.dashboard') ?? 'Dashboard' }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.login') ?? 'Client Area' }}
                        </a>
                    @endauth

                    <div class="w-px h-3 bg-cielo-dark/20"></div>

                    <div class="flex gap-4">
                        @foreach(['pt', 'en', 'fr'] as $lang)
                            <a href="{{ route('language.switch', $lang) }}" 
                               class="{{ app()->getLocale() === $lang ? 'text-cielo-terracotta underline decoration-1 underline-offset-4' : 'hover:text-cielo-dark transition-colors' }}">
                                {{ strtoupper($lang) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Navegação Principal --}}
                <nav class="space-y-4 md:space-y-6 mt-8 md:mt-12">
                    
                    <a href="{{ route('home') }}" class="block font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4">
                        {{ __('nav.home') ?? 'Home' }}
                    </a>

                    <a href="{{ route('properties.index') }}" class="block font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4">
                        {{ __('nav.curation') ?? 'Properties' }}
                    </a>

                    {{-- Dropdowns --}}
                    <div x-data="{ brandOpen: false }">
                        <button @click="brandOpen = !brandOpen" class="flex items-center justify-between w-full font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4 focus:outline-none group text-left">
                            <span>{{ __('nav.corporate') ?? 'The Brand' }}</span>
                            <svg class="w-6 h-6 md:w-8 md:h-8 transform transition-transform duration-300 text-cielo-navy/30 group-hover:text-cielo-terracotta" :class="brandOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="brandOpen" x-collapse class="pl-6 mt-4 space-y-3 border-l-2 border-cielo-dark/5 ml-4">
                            <a href="{{ route('pages.about') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.concept') ?? 'Concept' }}</a>
                            <a href="{{ route('pages.partners') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.partners') ?? 'Partners' }}</a>
                            <a href="{{ route('pages.recruitment') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.recruitment') ?? 'Careers' }}</a>
                        </div>
                    </div>

                    <div x-data="{ toolsOpen: false }">
                        <button @click="toolsOpen = !toolsOpen" class="flex items-center justify-between w-full font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4 focus:outline-none group text-left">
                            <span>{{ __('nav.simulators') ?? 'Tools' }}</span>
                            <svg class="w-6 h-6 md:w-8 md:h-8 transform transition-transform duration-300 text-cielo-navy/30 group-hover:text-cielo-terracotta" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="toolsOpen" x-collapse class="pl-6 mt-4 space-y-3 border-l-2 border-cielo-dark/5 ml-4">
                            <a href="{{ route('tools.gains') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.capital_gains') ?? 'Gains' }}</a>
                            <a href="{{ route('tools.imt') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.imt') ?? 'IMT' }}</a>
                            <a href="{{ route('tools.credit') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('nav.credit') ?? 'Credit' }}</a>
                            <a href="{{ route('tools.feng-shui') }}" class="block font-sans text-base md:text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">{{ __('fengshui.title') ?? 'Feng Shui' }}</a>
                        </div>
                    </div>

                    <a href="{{ route('blog.index') }}" class="block font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4">
                        {{ __('nav.journal') ?? 'Journal' }}
                    </a>
                    
                    <a href="{{ route('pages.contact') }}" class="block font-display text-4xl md:text-6xl text-cielo-dark hover:text-cielo-terracotta transition-all duration-300 hover:pl-4">
                        {{ __('nav.contact') ?? 'Contact' }}
                    </a>

                </nav>

                {{-- Footer do Menu --}}
                <div class="mt-8 md:mt-12 pt-8 border-t border-cielo-dark/10">
                    <a href="{{ route('access-request.create') }}" class="flex items-center justify-between group mb-8">
                        <span class="font-display text-xl md:text-2xl text-cielo-terracotta group-hover:underline">
                            {{ __('nav.request_access') ?? 'Solicitar Acesso' }}
                        </span>
                        <span class="w-8 h-8 md:w-10 md:h-10 rounded-full border border-cielo-terracotta flex items-center justify-center text-cielo-terracotta group-hover:bg-cielo-terracotta group-hover:text-white transition-all">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </a>

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 text-cielo-navy text-sm font-sans">
                        <div class="space-y-1">
                            <p class="font-bold uppercase tracking-widest text-xs opacity-50">Contato</p>
                            <p>+351 920 383 259</p>
                            <p>info@cielo.pt</p>
                        </div>
                        <div class="flex gap-6">
                            <a href="https://www.instagram.com/casablanca.pt/" target="_blank" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1 hover:text-cielo-terracotta hover:border-cielo-terracotta transition-colors">Instagram</a>
                            <a href="https://www.facebook.com/casablancaproperty" target="_blank" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1 hover:text-cielo-terracotta hover:border-cielo-terracotta transition-colors">Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. CONTEÚDO PRINCIPAL (Main) --}}
    {{-- FIX: pl-0 no Mobile (sem barra) e pl-20 no Desktop (com barra) --}}
    <main class="pl-0 md:pl-20 min-h-screen w-full relative z-0">
        {{ $slot }}
    </main>

    {{-- COMPONENTES GLOBAIS --}}
    <x-floating-ui />
    <x-exit-intent-popup />

    @if(view()->exists('components.chatbot'))
        <x-chatbot />
    @endif
    
    @if(view()->exists('components.cookie-banner'))
        <x-cookie-banner />
    @endif

</body>
</html>