<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')
    
    <main>
        {{-- HERO SECTION --}}
        <div class="relative w-full h-screen">
            <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Luxury" class="absolute inset-0 w-full h-full object-cover">
            {{-- Overlay Gradiente --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80"></div>
            
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4 pt-20">
                
                {{-- LOGO HERO (SLIM GLASSMORPHISM) --}}
                {{-- mb-12: Margem inferior ajustada --}}
                <div class="relative inline-flex items-center justify-center mb-12 group animate-fade-in-up">
                    
                    {{-- 1. Glow (Aura mais suave e espalhada) --}}
                    <div class="absolute -inset-4 bg-gradient-to-r from-accent/10 to-white/10 rounded-full blur-xl opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                    
                    {{-- 2. O Cartão de Vidro (VERSÃO SLIM) --}}
                    {{-- px-12 / py-4: Muito mais fino verticalmente, mantendo a largura --}}
                    {{-- bg-gray-900/20: Mais transparente para se misturar com o fundo --}}
                    <div class="relative px-8 py-4 md:px-12 md:py-4 bg-gray-900/20 backdrop-blur-md border border-white/10 rounded-2xl shadow-2xl flex items-center justify-center">
                        
                        {{-- 3. A IMAGEM GIGANTE --}}
                        {{-- h-40/h-80: Tamanho mantido grande --}}
                        {{-- -my-14 / -my-28: Margens negativas aumentadas para compensar o cartão mais fino --}}
                        <img 
                            src="{{ asset('images/hero.png') }}" 
                            alt="Crow Global Hero" 
                            class="h-40 md:h-80 w-auto object-contain -my-14 md:-my-28 filter drop-shadow-2xl transition-transform duration-300 group-hover:scale-105 relative z-10"
                        >
                    </div>
                </div>

                <h1 class="font-heading text-5xl md:text-8xl font-bold mb-6 animate-fade-in-up leading-tight relative z-0">
                    <span class="text-white drop-shadow-lg">CROW</span>
                    <span class="text-accent drop-shadow-lg">GLOBAL</span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 font-light tracking-widest max-w-3xl mx-auto animate-fade-in-up delay-100 text-gray-200 uppercase">
                    {{ __('Premium Real Estate Investments in Portugal') }}
                </p>
                
                {{-- SEARCH BAR --}}
                <div class="w-full max-w-4xl animate-fade-in-up delay-200 z-10">
                    <form action="{{ route('properties.index') }}" method="GET" class="bg-white/10 backdrop-blur-xl border border-white/20 p-2 rounded-full flex flex-col md:flex-row gap-2 shadow-2xl ring-1 ring-white/10">
                        
                        <div class="flex-1 relative group">
                            <select name="city" class="block w-full pl-6 pr-10 py-4 bg-transparent border-none text-white placeholder-gray-300 focus:ring-0 focus:bg-white/5 rounded-full cursor-pointer text-base">
                                <option value="" class="text-gray-900">{{ __('City') }} ({{ __('All') }})</option>
                                <option value="Lisboa" class="text-gray-900">Lisboa</option>
                                <option value="Porto" class="text-gray-900">Porto</option>
                                <option value="Cascais" class="text-gray-900">Cascais</option>
                                <option value="Faro" class="text-gray-900">Faro</option>
                            </select>
                        </div>

                        <div class="w-px bg-white/20 my-3 hidden md:block"></div>

                        <div class="flex-1 relative group">
                            <select name="type" class="block w-full pl-6 pr-10 py-4 bg-transparent border-none text-white placeholder-gray-300 focus:ring-0 focus:bg-white/5 rounded-full cursor-pointer text-base">
                                <option value="" class="text-gray-900">{{ __('Property Type') }}</option>
                                <option value="apartment" class="text-gray-900">{{ __('Apartment') }}</option>
                                <option value="villa" class="text-gray-900">{{ __('Villa') }}</option>
                                <option value="land" class="text-gray-900">{{ __('Land') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-accent hover:bg-white hover:text-accent text-white font-bold py-3 px-10 rounded-full transition-all duration-300 shadow-lg flex items-center justify-center gap-2 text-lg">
                            <span>{{ __('Search') }}</span>
                        </button>
                    </form>
                </div>

                <div class="mt-12 animate-fade-in-up delay-300">
                    <a href="{{ route('pages.sell') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-300 hover:text-white border-b border-white/20 hover:border-white transition-all pb-1 hover:gap-3">
                        {{ __('Do you have a property to sell?') }} 
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- VALUE PROPOSITION --}}
        <section class="py-24 bg-background relative">
             <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-20 bg-gradient-to-b from-transparent to-border"></div>
             
             <div class="container mx-auto px-4 text-center max-w-4xl">
                <h2 class="text-4xl md:text-5xl font-heading font-bold mb-8 leading-tight">{{ __('Where Vision Meets Value') }}</h2>
                <p class="text-muted-foreground text-xl mb-10 font-light leading-relaxed">
                    {{ __('Crow Global Investments connects international capital to exceptional properties across Portugal, delivering a boutique consulting experience with complete transparency.') }}
                </p>
                <div class="flex justify-center gap-8">
                    <a href="{{ route('pages.about') }}" class="text-accent font-bold hover:text-foreground transition-colors uppercase tracking-wider text-sm">{{ __('Our Story') }}</a>
                    <span class="text-border">|</span>
                    <a href="{{ route('pages.services') }}" class="text-accent font-bold hover:text-foreground transition-colors uppercase tracking-wider text-sm">{{ __('Our Services') }}</a>
                </div>
            </div>
        </section>

        {{-- TOP DESTINATIONS (MUNICIPALITIES) --}}
        @include('components.municipalities')

        {{-- FEATURED PROPERTIES --}}
        @if(isset($featuredProperties) && $featuredProperties->count() > 0)
        <section class="py-24 bg-gray-50/50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-end mb-16 px-2">
                    <div>
                        <span class="text-accent font-bold uppercase tracking-widest text-xs mb-2 block">{{ __('Portfolio') }}</span>
                        <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900">{{ __('Latest Opportunities') }}</h2>
                    </div>
                    <a href="{{ route('properties.index') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-gray-900 hover:text-accent transition-colors group">
                        {{ __('View All') }} 
                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($featuredProperties as $property)
                    <a href="{{ route('properties.show', $property) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 border border-gray-100">
                        <div class="relative h-72 overflow-hidden">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors z-10"></div>
                            <img src="{{ Storage::url($property->cover_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-white/95 backdrop-blur px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide text-gray-900">
                                    {{ __($property->type) }}
                                </span>
                            </div>
                            
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                <span class="text-white text-sm font-medium">{{ __('View Details') }}</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="font-bold text-xl mb-2 text-gray-900 group-hover:text-accent transition-colors truncate">{{ $property->title }}</h3>
                            <p class="text-gray-500 text-sm mb-6 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $property->city }}
                            </p>
                            <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                                <span class="font-heading font-bold text-2xl text-accent">€ {{ number_format($property->price, 0, ',', '.') }}</span>
                                <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-accent group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                
                <div class="mt-12 text-center md:hidden">
                    <a href="{{ route('properties.index') }}" class="inline-block px-8 py-3 bg-gray-900 text-white rounded-full font-bold text-sm shadow-lg">
                        {{ __('View All Properties') }}
                    </a>
                </div>
            </div>
        </section>
        @endif
        
        @include('components.off-market-cta')
    </main>
    
    @include('components.footer')
</x-public-layout>