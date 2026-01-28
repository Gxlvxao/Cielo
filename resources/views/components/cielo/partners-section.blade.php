<section class="bg-white py-32 relative z-30 rounded-t-[3rem] -mt-12 overflow-hidden border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto text-center px-6">
        
        {{-- CABEÇALHO (Apenas Label e Título) --}}
        <div class="max-w-4xl mx-auto mb-20" 
             x-data="{ shown: false }" 
             x-intersect.once="shown = true">
            
            {{-- Label --}}
            <span class="text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block transition-all duration-1000"
                  :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                {{ __('home.partners.label') ?? 'Global Network' }}
            </span>
            
            {{-- Título Principal --}}
            <h2 class="font-display text-5xl md:text-7xl text-cielo-dark transition-all duration-1000 delay-100 leading-none"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                {{ __('home.partners.title') ?? 'Nossos Parceiros' }}
            </h2>
            
            {{-- REMOVIDO: Texto descritivo/parágrafo --}}
        </div>

    </div>

    {{-- CARROSSEL INFINITO (Restaurado) --}}
    <div class="relative w-full py-12 bg-white">
        
        {{-- Gradient Fade (Esquerda) --}}
        <div class="absolute left-0 top-0 bottom-0 w-24 md:w-48 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        
        {{-- Gradient Fade (Direita) --}}
        <div class="absolute right-0 top-0 bottom-0 w-24 md:w-48 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

        {{-- Container da Animação --}}
        <div class="flex overflow-hidden group">
            {{-- Faixa de itens (Duplicada para o loop infinito) --}}
            <div class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap">
                
                {{-- Loop x4 para garantir cobertura em telas ultra-wide --}}
                @for ($x = 0; $x < 4; $x++) 
                    <div class="flex items-center shrink-0">
                        {{-- Itens Reais --}}
                        @foreach(range(1, 8) as $i)
                            <div class="mx-12 md:mx-20 flex items-center justify-center opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500 cursor-pointer hover:scale-110">
                                @if($i == 1)
                                    {{-- Logo Maxsell --}}
                                    <img src="{{ asset('images/maxsell.png') }}" alt="Maxsell" class="h-8 md:h-12 w-auto object-contain">
                                @else
                                    {{-- Placeholder Partners (Texto elegante simulando logo) --}}
                                    <span class="font-serif text-2xl md:text-3xl text-stone-400 whitespace-nowrap">
                                        Partner {{ $i }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endfor

            </div>
        </div>
    </div>
</section>

{{-- Estilo da animação (caso não tenha no tailwind.config.js) --}}
<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 60s linear infinite; /* 60s para ficar bem suave/lento (Quiet Luxury) */
    }
</style>