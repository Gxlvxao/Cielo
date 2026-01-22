@props(['properties'])

<section class="bg-white py-32 px-6 relative z-10 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        {{-- CABEÇALHO DA SEÇÃO --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div class="max-w-2xl">
                <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block">
                    {{ __('home.properties.label') }}
                </span>
                <h2 class="font-inter font-light text-5xl md:text-7xl text-cielo-dark leading-[1.1]">
                    {!! __('home.properties.title') !!}
                </h2>
            </div>

            <div class="hidden md:block pb-2">
                <a href="{{ route('properties.index') }}" class="group relative inline-block overflow-hidden h-6 text-sm font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                    <span class="block transition-transform duration-500 ease-in-out group-hover:-translate-y-full">
                        {{ __('home.properties.view_all') }}
                    </span>
                    <span class="block absolute top-0 left-0 w-full transition-transform duration-500 ease-in-out translate-y-full group-hover:translate-y-0">
                        {{ __('home.properties.view_all') }}
                    </span>
                    <span class="absolute bottom-0 left-0 w-full h-px bg-current transform scale-x-100 group-hover:scale-x-0 transition-transform duration-500 origin-right"></span>
                    <span class="absolute bottom-0 left-0 w-full h-px bg-cielo-terracotta transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left delay-100"></span>
                </a>
            </div>
        </div>

        {{-- GRID DE IMÓVEIS (Destaques) --}}
        {{-- Usei gap-10 (40px) que é um equilíbrio perfeito para separar sem desconectar --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
            @foreach($properties->take(3) as $property)
                <div class="group cursor-pointer flex flex-col h-full" onclick="window.location='{{ route('properties.show', $property) }}'">
                    
                    {{-- 1. FOTO ALTA (Portrait 2:3 - Bem Retangular) --}}
                    <div class="relative overflow-hidden w-full aspect-[2/3] bg-gray-100 mb-8 shadow-sm">
                        <img src="{{ Storage::url($property->cover_image) }}" 
                             class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" 
                             alt="{{ $property->title }}">
                        
                        {{-- Badge Off-Market --}}
                        @if($property->is_exclusive)
                            <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md text-cielo-dark px-3 py-2 text-[10px] font-bold uppercase tracking-widest z-10">
                                Off-Market
                            </div>
                        @endif
                        
                        {{-- Overlay suave --}}
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
                    </div>

                    {{-- 2. INFORMAÇÕES --}}
                    <div class="flex flex-col flex-grow px-1">
                        
                        {{-- Título --}}
                        <h3 class="font-inter font-light text-2xl text-cielo-dark mb-2 group-hover:text-cielo-terracotta transition-colors truncate">
                            {{ $property->title }}
                        </h3>
                        
                        {{-- Descrição --}}
                        <p class="font-inter font-light text-cielo-navy/60 text-sm leading-relaxed line-clamp-2 mb-6 h-10">
                            {{ $property->description }}
                        </p>

                        {{-- Separador --}}
                        <div class="w-full h-px bg-gray-100 mb-5 group-hover:bg-cielo-terracotta/30 transition-colors duration-500"></div>

                        {{-- Specs com ÍCONES PREMIUM (Finos) --}}
                        <div class="flex items-center justify-between text-cielo-dark">
                            
                            {{-- Quartos --}}
                            @if($property->bedrooms)
                                <div class="flex items-center gap-3">
                                    {{-- Ícone Cama (Fino) --}}
                                    <svg class="w-5 h-5 text-cielo-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    <div class="flex flex-col leading-none">
                                        <span class="font-inter text-lg font-light">{{ $property->bedrooms }}</span>
                                        <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Quartos</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Banheiros --}}
                            @if($property->bathrooms)
                                <div class="flex items-center gap-3 border-l border-gray-100 pl-5">
                                    {{-- Ícone Banheira (Fino) --}}
                                    <svg class="w-5 h-5 text-cielo-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <div class="flex flex-col leading-none">
                                        <span class="font-inter text-lg font-light">{{ $property->bathrooms }}</span>
                                        <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Banhos</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Área --}}
                            @if($property->area)
                                <div class="flex items-center gap-3 border-l border-gray-100 pl-5">
                                    {{-- Ícone Área (Fino) --}}
                                    <svg class="w-5 h-5 text-cielo-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                    <div class="flex flex-col leading-none">
                                        <span class="font-inter text-lg font-light">{{ intval($property->area) }}<span class="text-xs align-top opacity-40 ml-[1px]">m²</span></span>
                                        <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Área</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Botão Mobile (Ver Todos) --}}
        <div class="mt-20 text-center md:hidden">
            <a href="{{ route('properties.index') }}" class="inline-block border border-cielo-dark text-cielo-dark px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-cielo-dark hover:text-white transition-colors">
                {{ __('home.properties.view_all') }}
            </a>
        </div>

    </div>
</section>