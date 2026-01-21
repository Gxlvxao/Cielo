<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cielo') }} - {{ __('seo.title') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans text-cielo-dark bg-cielo-cream antialiased" x-data="{ sidebarOpen: false }">

    <header class="fixed top-0 w-full z-50 px-6 py-6 flex justify-between items-center transition-all duration-300 mix-blend-difference text-white">
        <a href="{{ route('home') }}" class="font-serif text-3xl tracking-widest font-bold uppercase hover:opacity-80 transition">
            Cielo
        </a>

        <div class="flex items-center gap-8">
            
            @auth
                <a href="{{ route('admin.dashboard') }}" class="hidden md:block text-xs font-bold tracking-widest hover:text-cielo-accent transition-colors uppercase">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden md:block text-xs font-bold tracking-widest hover:text-cielo-accent transition-colors uppercase">
                    Client Area
                </a>
            @endauth

            <div class="hidden md:block w-px h-4 bg-white/30"></div>

            <div class="hidden md:flex gap-4 text-xs tracking-widest font-medium">
                <a href="{{ route('language.switch', 'pt') }}" class="{{ app()->getLocale() === 'pt' ? 'underline decoration-1 underline-offset-4' : 'opacity-60 hover:opacity-100' }}">PT</a>
                <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'underline decoration-1 underline-offset-4' : 'opacity-60 hover:opacity-100' }}">EN</a>
                <a href="{{ route('language.switch', 'fr') }}" class="{{ app()->getLocale() === 'fr' ? 'underline decoration-1 underline-offset-4' : 'opacity-60 hover:opacity-100' }}">FR</a>
            </div>

            <button @click="sidebarOpen = true" class="group flex items-center gap-3 focus:outline-none cursor-pointer">
                <span class="text-xs tracking-[0.2em] uppercase group-hover:tracking-[0.3em] transition-all duration-300">{{ __('nav.menu_label') }}</span>
                <div class="space-y-1.5">
                    <span class="block w-8 h-[2px] bg-white group-hover:w-10 transition-all"></span>
                    <span class="block w-8 h-[2px] bg-white group-hover:w-6 ml-auto transition-all"></span>
                </div>
            </button>
        </div>
    </header>

    <div x-cloak x-show="sidebarOpen" class="fixed inset-0 z-[60] flex justify-end">
        <div @click="sidebarOpen = false" 
             x-show="sidebarOpen"
             x-transition:enter="transition opacity duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-cielo-dark/90 backdrop-blur-sm cursor-pointer"></div>

        <div x-show="sidebarOpen"
             x-transition:enter="transition transform duration-500 ease-out"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform duration-500 ease-in"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="relative w-full md:w-[500px] h-full bg-cielo-cream p-12 flex flex-col justify-between shadow-2xl">
            
            <button @click="sidebarOpen = false" class="absolute top-8 right-8 p-2 hover:rotate-90 transition duration-300">
                <svg class="w-8 h-8 text-cielo-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <nav class="mt-20 space-y-6">
                @foreach([
                    __('nav.home') => 'home', 
                    __('nav.curation') => 'properties.index', 
                    __('nav.concept') => 'pages.about', 
                    __('nav.journal') => 'blog.index', 
                    __('nav.contact') => 'pages.contact'
                ] as $label => $route)
                    <a href="{{ route($route) }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="space-y-4 text-cielo-navy text-sm">
                <p>+351 912 345 678</p>
                <p>hello@cielo.com</p>
                <div class="flex gap-4 pt-4">
                    <a href="#" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1">Instagram</a>
                    <a href="#" class="uppercase tracking-widest text-xs border-b border-cielo-dark pb-1">LinkedIn</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        {{ $slot }}
    </main>

    <div class="fixed bottom-8 right-8 z-40">
        @include('components.cielo.chatbot-trigger')
    </div>
</body>
</html>