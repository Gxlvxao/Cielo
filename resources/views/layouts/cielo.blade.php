<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cielo - Boutique Real Estate</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans text-cielo-dark bg-cielo-cream antialiased" x-data="{ sidebarOpen: false }">

    <header class="fixed top-0 w-full z-50 px-6 py-6 flex justify-between items-center transition-all duration-300 mix-blend-difference text-white">
        <a href="{{ route('home') }}" class="font-serif text-3xl tracking-widest font-bold uppercase">
            Cielo
        </a>

        <button @click="sidebarOpen = true" class="group flex items-center gap-3 focus:outline-none">
            <span class="text-xs tracking-[0.2em] uppercase group-hover:tracking-[0.3em] transition-all duration-300">Menu</span>
            <div class="space-y-1.5">
                <span class="block w-8 h-[2px] bg-white group-hover:w-10 transition-all"></span>
                <span class="block w-8 h-[2px] bg-white group-hover:w-6 ml-auto transition-all"></span>
            </div>
        </button>
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
             class="absolute inset-0 bg-cielo-dark/90 backdrop-blur-sm"></div>

        <div x-show="sidebarOpen"
             x-transition:enter="transition transform duration-500 ease-out"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform duration-500 ease-in"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="relative w-full md:w-[500px] h-full bg-cielo-cream p-12 flex flex-col justify-between shadow-2xl overflow-y-auto">
            
            <button @click="sidebarOpen = false" class="absolute top-8 right-8 p-2">
                <svg class="w-8 h-8 text-cielo-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <nav class="mt-20 space-y-6">
                <a href="{{ route('home') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">Home</a>
                <a href="{{ route('properties.index') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">Curadoria</a>
                <a href="{{ route('pages.about') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">Conceito</a>
                
                {{-- MENU FERRAMENTAS COM DROPDOWN (ALPINE) --}}
                <div x-data="{ toolsOpen: false }" class="group">
                    <button @click="toolsOpen = !toolsOpen" class="flex items-center justify-between w-full font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300 focus:outline-none">
                        <span>Ferramentas</span>
                        <svg class="w-6 h-6 transform transition-transform duration-300" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="toolsOpen" x-collapse class="pl-8 mt-4 space-y-3 border-l border-cielo-dark/10 ml-4">
                        <a href="{{ route('tools.gains') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">Mais-Valias</a>
                        <a href="{{ route('tools.imt') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">Simulador IMT</a>
                        <a href="{{ route('tools.credit') }}" class="block text-lg uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">Crédito Habitação</a>
                    </div>
                </div>

                <a href="{{ route('blog.index') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">Jornal</a>
                <a href="{{ route('pages.contact') }}" class="block font-serif text-4xl text-cielo-dark hover:text-cielo-terracotta transition-colors italic hover:pl-4 duration-300">Conversa</a>
            </nav>

            <div class="space-y-4 text-cielo-navy text-sm mt-12">
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