@props(['properties'])

<section class="relative z-20 py-24 bg-white">
    
    {{-- 
        CONTAINER LIMPO
        - Removida a margem negativa (-mt).
        - Removido o background branco e sombras do container pai.
        - Agora é um fluxo natural de bloco.
    --}}
    <div class="container mx-auto px-6">
        
        {{-- Header Limpo (Sem caixa em volta) --}}
        <div class="flex flex-col md:flex-row items-end justify-between gap-6 mb-16">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-cielo-terracotta block mb-2">
                    
                </span>
                <h2 class="font-display text-4xl md:text-5xl text-cielo-dark leading-none">
                    Imóveis em Destaque
                </h2>
            </div>
            
            <a href="{{ route('properties.index') }}" class="group flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-cielo-navy hover:text-cielo-terracotta transition-colors">
                Ver todo o acervo
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        {{-- GRID DE IMÓVEIS --}}
        {{-- Removido o bg-white e shadow-xl que criava a "borda" --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-16 gap-x-8">
            
            @forelse($properties as $property)
                <article class="group cursor-pointer flex flex-col gap-6" onclick="window.location='{{ route('properties.show', $property) }}'">
                    
                    {{-- IMAGEM (Reto e Fino - Mantido) --}}
                    <div class="relative w-full aspect-[3/4] overflow-hidden bg-gray-100 shadow-lg group-hover:shadow-2xl transition-all duration-500">
                        {{-- Tag Flutuante --}}
                        @if($property->is_exclusive)
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-white/95 backdrop-blur text-cielo-dark px-3 py-1 text-[10px] font-bold uppercase tracking-widest shadow-sm">
                                    Off-Market
                                </span>
                            </div>
                        @endif

                        <img 
                            src="{{ $property->cover_image ? Storage::url($property->cover_image) : asset('images/placeholder.jpg') }}" 
                            alt="{{ $property->title }}" 
                            class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110"
                        >
                        
                        {{-- Overlay no Hover --}}
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500"></div>
                    </div>

                    {{-- INFORMAÇÕES (Limpo) --}}
                    <div class="flex flex-col gap-3">
                        {{-- Localização --}}
                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                            {{ $property->location ?? 'Portugal' }}
                        </p>

                        {{-- Título --}}
                        <h3 class="font-display text-2xl text-cielo-dark group-hover:text-cielo-terracotta transition-colors leading-tight">
                            {{ $property->title }}
                        </h3>

                        {{-- Linha Decorativa (apenas no hover para ficar mais clean ainda, ou fixa se preferir) --}}
                        <div class="h-px w-12 bg-gray-200 group-hover:w-full group-hover:bg-cielo-terracotta transition-all duration-500 ease-out"></div>

                        {{-- Specs --}}
                        <div class="flex items-center justify-between text-sm text-cielo-navy font-sans mt-1">
                            <div class="flex gap-4">
                                @if($property->bedrooms)
                                    <span>{{ $property->bedrooms }} <span class="text-gray-400 text-xs">Quartos</span></span>
                                @endif
                                @if($property->area)
                                    <span>{{ intval($property->area) }} <span class="text-gray-400 text-xs">m²</span></span>
                                @endif
                            </div>
                            
                            <div class="font-bold text-cielo-dark">
                                @if($property->price)
                                    € {{ number_format($property->price, 0, ',', '.') }}
                                @else
                                    Sob Consulta
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 py-12 text-center text-gray-400 font-light">
                    Nenhum destaque selecionado no momento.
                </div>
            @endforelse

        </div>
    </div>
</section>