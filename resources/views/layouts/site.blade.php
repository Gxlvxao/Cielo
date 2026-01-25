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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .menu-backdrop { backdrop-filter: blur(8px); }
    </style>
</head>
<body class="font-sans text-cielo-dark bg-cielo-cream antialiased selection:bg-cielo-terracotta selection:text-white" x-data="{ sidebarOpen: false }">

    {{-- PUBLIC HEADER (Fixo no topo) --}}
    <header class="fixed top-0 w-full z-50 px-6 py-6 flex justify-between items-center transition-all duration-300 mix-blend-difference text-white">
        <a href="{{ route('home') }}" class="font-serif text-3xl tracking-widest font-bold uppercase hover:opacity-80 transition z-50">
            Cielo
        </a>

        <div class="flex items-center gap-8 z-50">
            @auth
                <a href="{{ route('dashboard') }}" class="hidden md:block text-xs font-bold tracking-widest hover:text-cielo-terracotta transition-colors uppercase">
                    {{ __('nav.dashboard') ?? 'Dashboard' }}
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden md:block text-xs font-bold tracking-widest hover:text-cielo-terracotta transition-colors uppercase">
                    {{ __('nav.login') ?? 'Client Area' }}
                </a>
            @endauth

            <div class="hidden md:block w-px h-4 bg-white/30"></div>

            {{-- Language Switcher --}}
            <div class="hidden md:flex gap-4 text-xs tracking-widest font-medium">
                @foreach(['pt', 'en', 'fr'] as $lang)
                    <a href="{{ route('language.switch', $lang) }}" 
                       class="{{ app()->getLocale() === $lang ? 'underline decoration-1 underline-offset-4' : 'opacity-60 hover:opacity-100' }}">
                       {{ strtoupper($lang) }}
                    </a>
                @endforeach
            </div>

            {{-- Menu Trigger --}}
            <button @click="sidebarOpen = true" class="group flex items-center gap-3 focus:outline-none cursor-pointer">
                <span class="hidden md:block text-xs tracking-[0.2em] uppercase group-hover:tracking-[0.3em] transition-all duration-300">
                    {{ __('nav.menu_label') ?? 'MENU' }}
                </span>
                <div class="space-y-1.5">
                    <span class="block w-8 h-[2px] bg-white group-hover:w-10 transition-all"></span>
                    <span class="block w-8 h-[2px] bg-white group-hover:w-6 ml-auto transition-all"></span>
                </div>
            </button>
        </div>
    </header>

    {{-- PUBLIC SIDEBAR (Overlay) --}}
    <div x-cloak x-show="sidebarOpen" class="fixed inset-0 z-[60] flex justify-end">
        {{-- Backdrop --}}
        <div @click="sidebarOpen = false" 
             x-show="sidebarOpen"
             x-transition:enter="transition opacity duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-cielo-dark/90 menu-backdrop cursor-pointer"></div>

        {{-- Drawer Content --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="relative w-full md:w-[500px] h-full bg-cielo-cream p-12 flex flex-col justify-between shadow-2xl overflow-y-auto">
            
            <button @click="sidebarOpen = false" class="absolute top-8 right-8 p-2 hover:rotate-90 transition duration-300">
                <svg class="w-8 h-8 text-cielo-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <nav class="mt-20 space-y-6">
                {{-- Home --}}
                <a href="{{ route('home') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">
                    {{ __('nav.home') ?? 'Home' }}
                </a>

                {{-- Curadoria (Imóveis) --}}
                <a href="{{ route('properties.index') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">
                    {{ __('nav.curation') ?? 'Properties' }}
                </a>

                {{-- GRUPO 1: INSTITUCIONAL (Dropdown "The Brand") --}}
                <div x-data="{ brandOpen: false }">
                    <button @click="brandOpen = !brandOpen" class="flex items-center justify-between w-full font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300 focus:outline-none group">
                        <span>{{ __('nav.corporate') ?? 'The Brand' }}</span>
                        {{-- Seta que gira --}}
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-cielo-navy/50 group-hover:text-cielo-terracotta" :class="brandOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    {{-- Submenu Institucional --}}
                    <div x-show="brandOpen" x-collapse class="pl-8 mt-4 space-y-3 border-l border-cielo-dark/10 ml-4">
                        <a href="{{ route('pages.about') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.concept') ?? 'Concept' }}
                        </a>
                        <a href="{{ route('pages.partners') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.partners') ?? 'Partners' }}
                        </a>
                        <a href="{{ route('pages.recruitment') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.recruitment') ?? 'Careers' }}
                        </a>
                    </div>
                </div>

                {{-- GRUPO 2: FERRAMENTAS (Dropdown) --}}
                <div x-data="{ toolsOpen: false }">
                    <button @click="toolsOpen = !toolsOpen" class="flex items-center justify-between w-full font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300 focus:outline-none group">
                        <span>{{ __('nav.simulators') ?? 'Tools' }}</span>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-cielo-navy/50 group-hover:text-cielo-terracotta" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="toolsOpen" x-collapse class="pl-8 mt-4 space-y-3 border-l border-cielo-dark/10 ml-4">
                        <a href="{{ route('tools.gains') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.capital_gains') ?? 'Gains' }}
                        </a>
                        <a href="{{ route('tools.imt') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.imt') ?? 'IMT' }}
                        </a>
                        <a href="{{ route('tools.credit') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('nav.credit') ?? 'Credit' }}
                        </a>
                        <a href="{{ route('tools.feng-shui') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                            {{ __('fengshui.title') ?? 'Feng Shui' }}
                        </a>
                    </div>
                </div>

                {{-- Journal --}}
                <a href="{{ route('blog.index') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">
                    {{ __('nav.journal') ?? 'Journal' }}
                </a>
                
                {{-- Contacto --}}
                <a href="{{ route('pages.contact') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">
                    {{ __('nav.contact') ?? 'Contact' }}
                </a>

                {{-- CTA --}}
                <div class="pt-8 border-t border-cielo-dark/10 mt-8">
                    <a href="{{ route('access-request.create') }}" class="flex items-center justify-between group">
                        <span class="font-serif text-2xl text-cielo-terracotta italic hover:underline">
                            {{ __('nav.request_access') ?? 'Solicitar Acesso' }}
                        </span>
                        <span class="w-8 h-8 rounded-full border border-cielo-terracotta flex items-center justify-center text-cielo-terracotta group-hover:bg-cielo-terracotta group-hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </a>
                    <p class="text-[10px] uppercase tracking-widest text-cielo-navy/50 mt-2">Para Investidores & Parceiros</p>
                </div>

            </nav>

            {{-- Footer do Menu --}}
            <div class="space-y-4 text-cielo-navy text-sm mt-12">
                <p>+351 920 383 259</p>
                <p>info@cielo.pt</p>
                <div class="flex gap-4 pt-4">
                    <a href="https://www.instagram.com/casablanca.pt/" target="_blank" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1 hover:text-cielo-terracotta hover:border-cielo-terracotta transition-colors">Instagram</a>
                    <a href="https://www.facebook.com/casablancaproperty" target="_blank" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1 hover:text-cielo-terracotta hover:border-cielo-terracotta transition-colors">Facebook</a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTEÚDO DA PÁGINA --}}
    <main>
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