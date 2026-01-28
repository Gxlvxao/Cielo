<section class="bg-white relative py-20 lg:py-28 overflow-hidden" x-data="{ activeItem: 1 }">
    
    <div class="container mx-auto px-6">
        
        {{-- CABEÇALHO COMPACTO E ELEGANTE --}}
        <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8 border-b border-gray-100 pb-8">
            <div class="max-w-2xl relative">
                <span class="font-sans text-xs font-bold tracking-[0.2em] uppercase text-cielo-terracotta mb-3 block">
                    Nossa Essência
                </span>
                {{-- Reduzi de text-8xl para text-5xl/6xl --}}
                <h2 class="font-display text-4xl md:text-6xl text-cielo-dark leading-[0.95]">
                    {{ __('home.expertise.main_title') ?? 'Expertise & Lifestyle' }}
                </h2>
            </div>
            
            {{-- Texto de apoio mais discreto --}}
            <div class="max-w-xs text-right hidden md:block opacity-60">
                <p class="font-sans text-xs uppercase tracking-widest leading-relaxed">
                    Curadoria de momentos<br>
                    Exclusividade em cada detalhe
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            {{-- 
                COLUNA DA ESQUERDA: LISTA (Compactada) 
                Reduzi os paddings (py-6) e o tamanho das fontes.
            --}}
            <div class="lg:col-span-6 space-y-0">
                @foreach(range(1, 5) as $i)
                    <div 
                        class="group relative border-b border-gray-100 py-6 cursor-pointer transition-all duration-500"
                        @mouseenter="activeItem = {{ $i }}"
                    >
                        <div class="flex flex-col md:flex-row md:items-center gap-6 relative z-10">
                            
                            {{-- Número menor e mais discreto --}}
                            <span class="font-mono text-xs text-gray-300 group-hover:text-cielo-terracotta transition-colors duration-300 w-8">
                                0{{ $i }}
                            </span>

                            <div class="flex-1">
                                {{-- Título reduzido para 3xl (era 5xl) --}}
                                <h3 class="font-display text-2xl md:text-3xl text-cielo-dark group-hover:translate-x-2 transition-transform duration-500 ease-out">
                                    {{ __("home.expertise.$i.title") }}
                                </h3>
                                
                                {{-- Descrição aparece de forma mais sutil --}}
                                <div class="max-w-sm overflow-hidden transition-all duration-500 max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 group-hover:mt-3">
                                    <p class="font-sans text-gray-500 text-sm leading-relaxed">
                                        {{ __("home.expertise.$i.desc") }}
                                    </p>
                                </div>
                            </div>

                            {{-- Seta Minimalista --}}
                            <div class="opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-500 text-cielo-terracotta text-lg">
                                →
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 
                COLUNA DA DIREITA: IMAGEM (Vibes)
                Reduzi a altura e deixei mais "Portrait/Editorial"
            --}}
            <div class="hidden lg:block lg:col-span-6 relative h-full min-h-[500px]">
                <div class="sticky top-24 w-full max-w-md mx-auto aspect-[3/4] rounded-t-[10rem] rounded-b-[2rem] overflow-hidden shadow-2xl bg-gray-50">
                    
                    @foreach(range(1, 5) as $i)
                        @php
                            // SUGESTÃO DE FOTOS "VIBES" (Substitua no seu public/images)
                            // 1. Uma chave antiga em cima de uma mesa de mármore
                            // 2. Um interior minimalista com luz do sol batendo
                            // 3. Uma taça de vinho ou café num ambiente aconchegante
                            // 4. Close num detalhe de arquitetura (uma textura)
                            // 5. Uma vista da janela desfocada
                            
                            $images = [
                                1 => 'images/hero-luxury.jpg', 
                                2 => 'images/about-team.jpg',    
                                3 => 'images/hero-luxury.jpg',     
                                4 => 'images/footer.jpg',    
                                5 => 'images/hero-luxury.jpg',  
                            ];
                            $currentImage = $images[$i] ?? 'images/hero-luxury.jpg';
                        @endphp

                        <img 
                            src="{{ asset($currentImage) }}" 
                            class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 ease-in-out transform"
                            :class="activeItem === {{ $i }} ? 'opacity-100 scale-100 grayscale-0' : 'opacity-0 scale-110 grayscale'"
                            alt="Lifestyle {{ $i }}"
                        >
                        
                        {{-- Overlay "Cinematic" (Mais escuro embaixo para leitura) --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-80"></div>
                        
                        {{-- Texto flutuante na imagem --}}
                        <div 
                            class="absolute bottom-10 left-0 w-full text-center text-white transition-all duration-700"
                            :class="activeItem === {{ $i }} ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        >
                            <span class="font-serif italic text-2xl tracking-wide block mb-1">
                                {{ __("home.expertise.$i.title") }}
                            </span>
                            <span class="text-[10px] uppercase tracking-[0.3em] opacity-80">
                                Experience
                            </span>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>