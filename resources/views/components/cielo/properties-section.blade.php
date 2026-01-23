@props(['properties'])

<section class="bg-white py-32 px-6 relative z-10 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        {{-- CABEÇALHO --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div class="max-w-2xl">
                <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block">
                    {{ __('home.properties.label') ?? 'Curadoria' }}
                </span>
                <h2 class="font-inter font-light text-5xl md:text-7xl text-cielo-dark leading-[1.1]">
                    {!! __('home.properties.title') ?? 'Energia & <br> Harmonia' !!}
                </h2>
            </div>

            <div class="hidden md:block pb-2">
                <a href="{{ route('properties.index') }}" class="group relative inline-block overflow-hidden h-6 text-sm font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                    <span class="block transition-transform duration-500 ease-in-out group-hover:-translate-y-full">
                        {{ __('home.properties.view_all') ?? 'Ver Todos' }}
                    </span>
                    <span class="block absolute top-0 left-0 w-full transition-transform duration-500 ease-in-out translate-y-full group-hover:translate-y-0">
                        {{ __('home.properties.view_all') ?? 'Ver Todos' }}
                    </span>
                    <span class="absolute bottom-0 left-0 w-full h-px bg-current transform scale-x-100 group-hover:scale-x-0 transition-transform duration-500 origin-right"></span>
                    <span class="absolute bottom-0 left-0 w-full h-px bg-cielo-terracotta transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left delay-100"></span>
                </a>
            </div>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
            @foreach($properties as $property)
                <div class="group cursor-pointer flex flex-col h-full" onclick="window.location='{{ route('properties.show', $property) }}'">
                    
                    {{-- FOTO --}}
                    <div class="relative overflow-hidden w-full aspect-[2/3] bg-gray-100 mb-8 shadow-sm">
                        <img src="{{ $property->cover_image ? Storage::url($property->cover_image) : asset('images/placeholder.jpg') }}" 
                             class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" 
                             alt="{{ $property->title }}">
                        
                        {{-- ================================================= --}}
                        {{-- BADGE: OFF-MARKET (Prioridade Alta) --}}
                        {{-- ================================================= --}}
                        @if($property->is_exclusive)
                            <div class="absolute top-6 left-6 bg-gray-900/90 backdrop-blur-md text-white px-3 py-2 text-[10px] font-bold uppercase tracking-widest z-10">
                                Off-Market
                            </div>
                        @endif

                        {{-- ================================================= --}}
                        {{-- BADGE: ENERGIA DA SEMANA (NOVIDADE AQUI!) --}}
                        {{-- ================================================= --}}
                        @if($property->is_energy_of_week)
                            <div class="absolute top-6 right-6 bg-white/95 backdrop-blur-md px-3 py-2 z-10 shadow-sm border border-yellow-100">
                                <span class="flex items-center gap-2 text-[10px] font-bold tracking-widest text-cielo-dark uppercase">
                                    <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    Energy Pick
                                </span>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
                    </div>

                    {{-- INFORMAÇÕES --}}
                    <div class="flex flex-col flex-grow px-1">
                        <h3 class="font-inter font-light text-2xl text-cielo-dark mb-2 group-hover:text-cielo-terracotta transition-colors truncate">
                            {{ $property->title }}
                        </h3>
                        
                        {{-- Se for Energia da Semana, mostra a frase de efeito, senão a descrição --}}
                        @if($property->is_energy_of_week && $property->energy_tagline)
                            <p class="font-serif italic text-cielo-terracotta text-sm mb-6 h-10">
                                "{{ $property->energy_tagline }}"
                            </p>
                        @else
                            <p class="font-inter font-light text-cielo-navy/60 text-sm leading-relaxed line-clamp-2 mb-6 h-10">
                                {{ $property->description }}
                            </p>
                        @endif

                        <div class="w-full h-px bg-gray-100 mb-5 group-hover:bg-cielo-terracotta/30 transition-colors duration-500"></div>

                        {{-- Specs --}}
                        <div class="flex items-center justify-between text-cielo-dark">
                            @if($property->bedrooms)
                                <div class="flex items-center gap-3">
                                    <span class="font-inter text-lg font-light">{{ $property->bedrooms }}</span>
                                    <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Quartos</span>
                                </div>
                            @endif

                            @if($property->area)
                                <div class="flex items-center gap-3 border-l border-gray-100 pl-5">
                                    <span class="font-inter text-lg font-light">{{ intval($property->area) }}<span class="text-xs align-top opacity-40 ml-[1px]">m²</span></span>
                                    <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Área</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Botão Mobile --}}
        <div class="mt-20 text-center md:hidden">
            <a href="{{ route('properties.index') }}" class="inline-block border border-cielo-dark text-cielo-dark px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-cielo-dark hover:text-white transition-colors">
                {{ __('home.properties.view_all') ?? 'Ver Todos' }}
            </a>
        </div>

    </div>
</section>