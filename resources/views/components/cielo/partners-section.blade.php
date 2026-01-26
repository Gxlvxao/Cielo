<section class="bg-white py-32 relative z-30 rounded-t-[3rem] -mt-12 overflow-hidden">
    <div class="max-w-[90rem] mx-auto text-center px-6">
        
        {{-- Cabeçalho da Seção (Mantido Original com Alpine) --}}
        <div class="max-w-3xl mx-auto mb-16" 
             x-data="{ shown: false, init() { const obs = new IntersectionObserver(e => { if(e[0].isIntersecting){ this.shown = true; obs.disconnect()} }, {threshold:0.1}); obs.observe(this.$el); } }">
            
            <span class="text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block transition-all duration-1000"
                  :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                {{ __('home.partners.label') }}
            </span>
            
            <h2 class="font-serif text-4xl md:text-6xl text-cielo-dark mb-8 transition-all duration-1000 delay-100"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                {{ __('home.partners.title') }}
            </h2>
            
            <p class="font-sans text-lg text-cielo-navy/80 leading-relaxed transition-all duration-1000 delay-200"
               :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                {{ __('home.partners.text') }}
            </p>
        </div>
    </div>

    {{-- Marquee Infinito --}}
    <div class="relative w-full py-10 bg-white">
        
        {{-- Gradient Fade (Esquerda) --}}
        <div class="absolute left-0 top-0 bottom-0 w-24 md:w-48 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        
        {{-- Gradient Fade (Direita) --}}
        <div class="absolute right-0 top-0 bottom-0 w-24 md:w-48 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

        {{-- Container da Animação --}}
        <div class="flex overflow-hidden group">
            {{-- Faixa de itens (Duplicada para o loop infinito) --}}
            <div class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap">
                
                {{-- Loop x2 para garantir que cubra telas grandes sem buracos --}}
                @for ($x = 0; $x < 2; $x++) 
                    <div class="flex items-center shrink-0">
                        {{-- Itens Reais --}}
                        @foreach(range(1, 8) as $i)
                            <div class="mx-8 md:mx-16 flex items-center justify-center opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500 cursor-pointer hover:scale-110">
                                @if($i == 1)
                                    {{-- Logo Maxsell --}}
                                    <img src="/images/maxsell.png" alt="Maxsell" class="h-10 md:h-14 w-auto object-contain">
                                @else
                                    {{-- Placeholder Partners (Simulando logotipos de luxo) --}}
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

{{-- 
    Sugestão Senior: Mova isso para o seu tailwind.config.js 
    mas mantive aqui para funcionar imediatamente no seu copy-paste.
--}}
<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 40s linear infinite;
    }
</style>