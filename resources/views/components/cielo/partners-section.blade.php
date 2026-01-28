<section class="bg-white py-10 relative z-30 rounded-t-[2rem] -mt-6 overflow-hidden border-b border-gray-100">
    
    {{-- CONFIGURAÇÃO DOS PARCEIROS (Nomes de arquivos corrigidos) --}}
    @php
        $partners = [
            ['src' => 'images/1.avif', 'alt' => 'Parceiro 1'],
            ['src' => 'images/2.avif', 'alt' => 'Parceiro 2'],
            ['src' => 'images/3.avif', 'alt' => 'Parceiro 3'],
            ['src' => 'images/4.avif', 'alt' => 'Parceiro 4'],
            ['src' => 'images/5.avif', 'alt' => 'Parceiro 5'],
            ['src' => 'images/6.png',  'alt' => 'Parceiro 6'],
            ['src' => 'images/7.png',  'alt' => 'Parceiro 7'],
            ['src' => 'images/8.avif', 'alt' => 'Parceiro 8'],
        ];
    @endphp

    <div class="max-w-[90rem] mx-auto text-center px-6">
        
        {{-- CABEÇALHO COMPACTO (Apenas a Tag Laranja) --}}
        <div class="max-w-4xl mx-auto mb-8" 
             x-data="{ shown: false }" 
             x-intersect.once="shown = true">
            
            {{-- Apenas o nomezinho pequeno e laranja --}}
            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-cielo-terracotta inline-block transition-all duration-1000"
                  :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ __('home.partners.title') ?? 'Nossos Parceiros' }}
            </span>
            
            {{-- Título H2 grande REMOVIDO --}}
        </div>

    </div>

    {{-- CARROSSEL INFINITO --}}
    <div class="relative w-full bg-white">
        
        {{-- Fades Laterais --}}
        <div class="absolute left-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

        <div class="flex overflow-hidden group">
            {{-- Faixa de animação --}}
            <div class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap items-center">
                
                {{-- Loop Multiplicador (x6) --}}
                @for ($x = 0; $x < 6; $x++) 
                    <div class="flex items-center shrink-0">
                        
                        @foreach($partners as $partner)
                            <div class="mx-8 md:mx-12 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500 cursor-pointer hover:scale-105">
                                <img src="{{ asset($partner['src']) }}" 
                                     alt="{{ $partner['alt'] }}" 
                                     class="h-8 md:h-10 w-auto object-contain"
                                     onerror="this.style.display='none'"
                                >
                            </div>
                        @endforeach

                    </div>
                @endfor

            </div>
        </div>
    </div>
</section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 80s linear infinite;
    }
</style>