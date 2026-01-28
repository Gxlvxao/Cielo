@props(['properties'])

<section id="properties-sticky-wrapper" class="relative w-full bg-gray-50">
    
    {{-- 
        CONTAINER STICKY 
        Este container FICA PARADO (h-screen sticky top-0) enquanto o pai (wrapper) rola.
    --}}
    <div class="sticky top-0 h-screen w-full overflow-hidden flex items-center justify-center">

        {{-- Título Fixo no Fundo (Opcional, dá profundidade) --}}
        <div class="absolute top-8 left-8 z-0 pointer-events-none opacity-40 mix-blend-multiply">
            <span class="font-sans text-[10px] font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-2 block">
                {{ __('home.properties.label') ?? 'Curadoria' }}
            </span>
            <h2 class="font-display text-4xl text-cielo-dark leading-none">
                Energia &<br>Harmonia
            </h2>
        </div>

        {{-- 
            ÁREA DOS CARDS 
            Ocupa a tela toda, com padding para criar a borda arredondada visível.
        --}}
        <div class="relative w-full h-full p-2 md:p-4 flex items-center justify-center">
            
            @foreach($properties as $index => $property)
                {{-- 
                    CARD INDIVIDUAL 
                    - Absolute inset-0: Ocupa todo o espaço do container
                    - rounded-[2.5rem]: Cantos bem redondos como pedido
                    - transform: Começa escondido em baixo (translateY 100%)
                --}}
                <div 
                    class="property-card absolute inset-2 md:inset-4 bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-gray-100 will-change-transform origin-bottom"
                    style="z-index: {{ $index + 1 }}; transform: translateY(110%);"
                >
                    {{-- FOTO (Esquerda) --}}
                    <div class="w-full lg:w-[65%] h-1/2 lg:h-full relative overflow-hidden group">
                        <img 
                            src="{{ $property->cover_image ? Storage::url($property->cover_image) : asset('images/placeholder.jpg') }}" 
                            alt="{{ $property->title }}" 
                            class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-105"
                        >
                        <div class="absolute inset-0 bg-black/10"></div>
                        
                        {{-- Badges --}}
                        <div class="absolute top-8 left-8 flex flex-col gap-2">
                            @if($property->is_exclusive)
                                <span class="bg-white/95 backdrop-blur-md text-cielo-dark px-4 py-2 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-sm">
                                    Off-Market
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- CONTEÚDO (Direita) --}}
                    <div class="w-full lg:w-[35%] h-1/2 lg:h-full bg-white p-8 lg:p-12 flex flex-col justify-center relative">
                        
                        {{-- Número do Slide --}}
                        <div class="absolute top-8 right-8 font-display text-5xl text-gray-100 select-none">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="mb-auto mt-4 lg:mt-12">
                            <h3 class="font-display text-4xl lg:text-5xl text-cielo-dark leading-[0.9] mb-6 cursor-pointer hover:text-cielo-terracotta transition-colors" onclick="window.location='{{ route('properties.show', $property) }}'">
                                {{ $property->title }}
                            </h3>
                            
                            @if($property->is_energy_of_week && $property->energy_tagline)
                                <div class="pl-4 border-l-2 border-cielo-terracotta">
                                    <p class="font-serif italic text-cielo-terracotta text-lg lg:text-xl">
                                        "{{ $property->energy_tagline }}"
                                    </p>
                                </div>
                            @else
                                <p class="font-sans text-sm lg:text-base text-gray-500 leading-7 line-clamp-4">
                                    {{ $property->description }}
                                </p>
                            @endif
                        </div>

                        {{-- Specs --}}
                        <div class="border-t border-gray-100 pt-8 mt-8 flex items-center gap-8">
                            @if($property->bedrooms)
                                <div>
                                    <span class="block font-display text-4xl text-cielo-dark">{{ $property->bedrooms }}</span>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">Quartos</span>
                                </div>
                            @endif
                            @if($property->area)
                                <div>
                                    <span class="block font-display text-4xl text-cielo-dark">{{ intval($property->area) }}</span>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">m² Área</span>
                                </div>
                            @endif
                        </div>

                        {{-- CTA --}}
                        <div class="mt-8">
                            <a href="{{ route('properties.show', $property) }}" class="inline-flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                                Ver Detalhes <span class="text-xl">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Barra de Progresso --}}
        <div class="hidden lg:block absolute right-0 top-0 h-full w-1 bg-gray-100 z-50">
            <div id="scroll-progress-bar" class="w-full bg-cielo-terracotta transition-all duration-75 ease-linear h-0"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('properties-sticky-wrapper');
    const cards = document.querySelectorAll('.property-card');
    const progressBar = document.getElementById('scroll-progress-bar');
    
    const totalCards = cards.length;
    
    // 1. Definição da Altura do Trilho (Track)
    // Cada card precisa de 100vh de scroll para passar.
    // Adicionamos +50vh para garantir que o último fique um tempo na tela antes de ir embora.
    wrapper.style.height = `${totalCards * 100}vh`;

    function onScroll() {
        // Se for mobile, ignoramos (o layout CSS resolve stackando normal ou podemos desabilitar)
        if (window.innerWidth < 1024) return;

        const rect = wrapper.getBoundingClientRect();
        const wrapperTop = rect.top; // Posição do topo do wrapper em relação à viewport
        const wrapperHeight = rect.height;
        const viewportHeight = window.innerHeight;

        // "scrolled" é quantos pixels já "entramos" na seção (invertendo o top negativo)
        const scrolled = -wrapperTop; 
        
        // Total de pixels disponíveis para scrollar dentro da seção
        const scrollableDistance = wrapperHeight - viewportHeight;

        // Progresso de 0.0 a 1.0
        let progress = scrolled / scrollableDistance;
        progress = Math.max(0, Math.min(1, progress));

        // Atualiza barra lateral
        if(progressBar) progressBar.style.height = `${progress * 100}%`;

        // LÓGICA DO BARALHO (STACKING)
        // Mapeamos o progresso para o índice dos cards.
        // Ex: 3 cards. Progresso vai de 0 a 2.99
        const stage = progress * (totalCards - 0.1); 
        
        cards.forEach((card, index) => {
            // "diff" diz o quão longe o card atual está do "foco"
            // Se diff > 0: Card já deve ter aparecido
            // Se diff < 0: Card ainda vai aparecer
            const diff = stage - index;

            if (index === 0) {
                // O primeiro card está sempre visível na base
                card.style.transform = `translateY(0)`;
                card.style.opacity = '1';
                // Opcional: Efeito de escala quando o próximo vem por cima
                // if (diff > 0) card.style.transform = `scale(${1 - (diff * 0.05)})`;
            } else {
                if (diff >= 0) {
                    // Card já "chegou". Fica fixo e visível cobrindo o anterior.
                    card.style.transform = `translateY(0)`;
                    card.style.opacity = '1';
                } else {
                    // Card está chegando.
                    // diff varia de -1 (longe) a 0 (chegou)
                    // Vamos animar a entrada quando diff estiver entre -1 e 0
                    if (diff > -1) {
                        const percent = Math.abs(diff) * 100; // 100% a 0%
                        // Ele vem de baixo (100% Y) até 0% Y
                        card.style.transform = `translateY(${percent}%)`;
                        // Fade in sutil
                        card.style.opacity = `${1 - Math.abs(diff) * 0.5}`; 
                    } else {
                        // Totalmente escondido lá embaixo
                        card.style.transform = `translateY(110%)`;
                        card.style.opacity = '0';
                    }
                }
            }
        });
    }

    // Otimização de performance
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                onScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Chama uma vez para garantir posição inicial
    onScroll();
});
</script>