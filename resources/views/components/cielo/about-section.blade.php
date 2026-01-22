<section class="bg-white py-40 px-6 min-h-screen flex items-center justify-center relative overflow-hidden" 
         x-data="{ 
            scrolled: false,
            init() {
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        this.scrolled = true;
                        observer.disconnect();
                    }
                }, { threshold: 0.1 });
                observer.observe(this.$el);
            }
         }">
    
    {{-- Reduzi o max-w para 5xl e adicionei mx-auto para garantir o foco central --}}
    <div class="max-w-5xl mx-auto text-center relative z-10">
        
        <div class="mb-12 overflow-hidden">
            {{-- Troquei para font-inter --}}
            <p class="font-inter text-xs font-bold tracking-[0.4em] uppercase text-cielo-terracotta transform transition-all duration-[1000ms] ease-out delay-300"
               :class="scrolled ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                {{ __('home.about.label') }}
            </p>
        </div>

        <div class="space-y-12 transition-all duration-[2000ms] ease-out"
             :class="scrolled ? 'blur-0 opacity-100 scale-100' : 'blur-xl opacity-30 scale-95'">
            
            {{-- 
                1. Removi 'font-serif' e coloquei 'font-inter'.
                2. Ajustei o leading para 'tight' e tracking para 'tight' para ficar mais moderno.
            --}}
            <h2 class="font-inter font-light text-4xl md:text-6xl lg:text-7xl leading-tight tracking-tight text-cielo-dark mb-8">
                {!! __('home.about.text') !!}
            </h2>

            {{-- 
                1. Reduzi o max-w para '2xl' para o texto não ficar muito "esticado" (leitura melhor).
                2. Fonte Inter também aqui.
            --}}
            <p class="font-inter text-lg md:text-xl text-cielo-navy/80 font-light leading-relaxed max-w-3xl mx-auto">
                {!! __('home.about.subtext') !!}
            </p>

        </div>

    </div>

    {{-- Mantive os detalhes visuais --}}
    <div class="absolute inset-0 pointer-events-none flex justify-between px-6 md:px-20 opacity-5">
        <div class="w-px h-full bg-cielo-dark"></div>
        <div class="w-px h-full bg-cielo-dark"></div>
    </div>
</section>