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
    
    <div class="max-w-[90rem] mx-auto text-center relative z-10">
        
        <div class="mb-16 overflow-hidden">
            <p class="text-sm font-bold tracking-[0.5em] uppercase text-cielo-terracotta transform transition-all duration-[1000ms] ease-out delay-300"
               :class="scrolled ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                {{ __('home.about.label') }}
            </p>
        </div>

        <div class="space-y-16 transition-all duration-[2000ms] ease-out"
             :class="scrolled ? 'blur-0 opacity-100 scale-100' : 'blur-xl opacity-30 scale-95'">
            
            <h2 class="font-serif text-5xl md:text-7xl lg:text-8xl leading-tight text-cielo-dark font-light">
                {!! __('home.about.text') !!}
            </h2>

            <p class="font-sans text-xl md:text-2xl lg:text-3xl text-cielo-navy font-light leading-relaxed max-w-4xl mx-auto opacity-80">
                {!! __('home.about.subtext') !!}
            </p>

        </div>

    </div>

    <div class="absolute inset-0 pointer-events-none flex justify-between px-6 md:px-20 opacity-5">
        <div class="w-px h-full bg-cielo-dark"></div>
        <div class="w-px h-full bg-cielo-dark"></div>
    </div>
</section>