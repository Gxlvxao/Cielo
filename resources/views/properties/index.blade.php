<x-cielo-layout>

    {{-- 1. HERO HEADER (Imagem Parcial com Texto) --}}
    <div class="relative w-full h-[60vh] min-h-[500px] bg-cielo-dark">
        {{-- Imagem de Fundo (Escurecida para leitura) --}}
        <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Cielo Curated Properties" class="absolute inset-0 w-full h-full object-cover opacity-60">
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/40"></div>

        {{-- Texto Centralizado --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-white/80 mb-6 animate-fade-in-up">
                {{ __('properties.header.label') }}
            </span>
            
            <h1 class="font-serif text-4xl md:text-6xl text-white mb-6 max-w-4xl leading-tight animate-fade-in-up delay-100">
                {{ __('properties.header.title') }}
            </h1>

            <p class="font-inter font-light text-lg md:text-xl text-white/90 max-w-2xl animate-fade-in-up delay-200">
                {{ __('properties.header.subtitle') }}
            </p>
        </div>
    </div>

    {{-- 2. BARRA DE PESQUISA E FILTROS --}}
    <div class="relative z-20 -mt-8 px-6 mb-20">
        <div class="max-w-6xl mx-auto bg-white shadow-xl p-6 md:p-8">
            <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                
                {{-- Busca por Palavra-Chave --}}
                <div class="md:col-span-2 space-y-2">
                    <label for="search" class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">
                        {{ __('properties.search.keyword') }}
                    </label>
                    <div class="relative border-b border-gray-200 focus-within:border-cielo-dark transition-colors">
                        <input type="text" name="search" id="search" 
                               value="{{ request('search') }}"
                               placeholder="{{ __('properties.search.placeholder') }}"
                               class="w-full border-none p-0 pb-2 text-lg font-serif text-cielo-dark focus:ring-0 placeholder-gray-300">
                        <svg class="w-5 h-5 text-cielo-dark absolute right-0 bottom-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                {{-- Filtro de Localização (Se tiver municípios) --}}
                <div class="space-y-2">
                    <label for="location" class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">
                        {{ __('properties.search.location') }}
                    </label>
                    <div class="relative border-b border-gray-200 focus-within:border-cielo-dark transition-colors">
                        <select name="location" id="location" class="w-full border-none p-0 pb-2 text-lg font-serif text-cielo-dark focus:ring-0 bg-transparent cursor-pointer">
                            <option value="">{{ __('properties.search.all_locations') }}</option>
                            {{-- Aqui você iteraria sobre $municipalities se o controller passar --}}
                            <option value="lisboa" {{ request('location') == 'lisboa' ? 'selected' : '' }}>Lisboa</option>
                            <option value="porto" {{ request('location') == 'porto' ? 'selected' : '' }}>Porto</option>
                            <option value="algarve" {{ request('location') == 'algarve' ? 'selected' : '' }}>Algarve</option>
                        </select>
                    </div>
                </div>

                {{-- Botão Filtrar --}}
                <div>
                    <button type="submit" class="w-full bg-cielo-dark text-white h-12 flex items-center justify-center text-xs font-bold uppercase tracking-widest hover:bg-cielo-terracotta transition-colors duration-300">
                        {{ __('properties.search.submit') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- 3. GRID DE IMÓVEIS (3 POR LINHA) --}}
    <section class="pb-32 px-6">
        <div class="max-w-[90rem] mx-auto">
            
            {{-- Loop dos Imóveis --}}
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-20">
                    @foreach($properties as $property)
                        <div class="group cursor-pointer flex flex-col h-full" onclick="window.location='{{ route('properties.show', $property) }}'">
                            
                            {{-- Foto (Aspecto 2:3 - Vertical) --}}
                            <div class="relative overflow-hidden w-full aspect-[2/3] bg-gray-100 mb-8 shadow-sm">
                                <img src="{{ Storage::url($property->cover_image) }}" 
                                     class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" 
                                     alt="{{ $property->title }}">
                                
                                @if($property->is_exclusive)
                                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md text-cielo-dark px-3 py-2 text-[10px] font-bold uppercase tracking-widest z-10">
                                        Off-Market
                                    </div>
                                @endif
                                
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
                            </div>

                            {{-- Informações --}}
                            <div class="flex flex-col flex-grow px-1">
                                <h3 class="font-inter font-light text-2xl text-cielo-dark mb-2 group-hover:text-cielo-terracotta transition-colors truncate">
                                    {{ $property->title }}
                                </h3>
                                
                                <p class="font-inter font-light text-cielo-navy/60 text-sm leading-relaxed line-clamp-2 mb-6 h-10">
                                    {{ $property->description }}
                                </p>

                                <div class="w-full h-px bg-gray-100 mb-5 group-hover:bg-cielo-terracotta/30 transition-colors duration-500"></div>

                                {{-- Specs --}}
                                <div class="flex items-center justify-between text-cielo-dark">
                                    @if($property->bedrooms)
                                        <div class="flex items-center gap-2">
                                            <span class="font-inter text-lg font-light">{{ $property->bedrooms }}</span>
                                            <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Quartos</span>
                                        </div>
                                    @endif

                                    @if($property->bathrooms)
                                        <div class="flex items-center gap-2 border-l border-gray-100 pl-4">
                                            <span class="font-inter text-lg font-light">{{ $property->bathrooms }}</span>
                                            <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Banhos</span>
                                        </div>
                                    @endif

                                    @if($property->area)
                                        <div class="flex items-center gap-2 border-l border-gray-100 pl-4">
                                            <span class="font-inter text-lg font-light">{{ intval($property->area) }}<span class="text-xs align-top opacity-40 ml-[1px]">m²</span></span>
                                            <span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Área</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginação --}}
                <div class="mt-20">
                    {{ $properties->links() }}
                </div>

            @else
                {{-- Estado Vazio --}}
                <div class="text-center py-20">
                    <h3 class="font-serif text-2xl text-cielo-dark mb-4">{{ __('properties.no_results') }}</h3>
                    <p class="text-cielo-navy/60">{{ __('properties.try_adjusting') }}</p>
                </div>
            @endif

        </div>
    </section>

    <x-cielo.footer-big />

</x-cielo-layout>