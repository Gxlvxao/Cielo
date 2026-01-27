<section class="bg-background py-24 md:py-32 min-h-[60vh] flex items-center justify-center relative overflow-hidden" 
         x-data="{ 
            scrolled: false,
            init() {
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        this.scrolled = true;
                        observer.disconnect();
                    }
                }, { threshold: 0.2 });
                observer.observe(this.$el);
            }
         }">
    
    {{-- Decoração de fundo --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-cielo-cream/10 -skew-x-12 translate-x-1/2 pointer-events-none" aria-hidden="true"></div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        
        {{-- Wrapper (Reduzi o space-y de 16 para 10) --}}
        <div class="max-w-4xl mx-auto space-y-10 transition-all duration-[2000ms] ease-out"
             :class="scrolled ? 'blur-0 opacity-100 scale-100' : 'blur-xl opacity-0 scale-95'">
            
            {{-- Label --}}
            <div>
                <span class="inline-block text-xs font-sans font-bold tracking-[0.4em] text-cielo-terracotta uppercase">
                    {{ __('philosophy.label') }}
                </span>
            </div>

            {{-- Título (Reduzido de 9xl para 5xl/6xl) --}}
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl leading-tight text-cielo-dark">
                {!! __('philosophy.title') !!}
            </h2>

            {{-- Blocos de Texto --}}
            <div class="space-y-6">
                {{-- Subtítulo (Reduzido de 3xl para 2xl) --}}
                <p class="font-sans text-xl md:text-2xl text-cielo-navy font-light leading-snug max-w-2xl mx-auto">
                    {{ __('philosophy.subtitle') }}
                </p>
                
                {{-- Texto Corrido (Reduzido para base/lg) --}}
                <p class="font-sans text-base md:text-lg text-muted-foreground leading-relaxed max-w-xl mx-auto">
                    {{ __('philosophy.text') }}
                </p>
            </div>

            {{-- Botão --}}
            <div class="pt-6">
                <a href="{{ route('properties.index') }}" 
                   class="inline-flex flex-col items-center group">
                    <span class="text-xs font-bold uppercase tracking-widest text-cielo-dark group-hover:text-cielo-terracotta transition-colors mb-2">
                        {{ __('philosophy.cta') }}
                    </span>
                    <span class="h-px w-8 bg-cielo-dark group-hover:w-16 group-hover:bg-cielo-terracotta transition-all duration-500 ease-out"></span>
                </a>
            </div>

        </div>
    </div>
</section>