<section class="bg-white py-32 px-6 relative z-30 rounded-t-[3rem] -mt-12">
    <div class="max-w-[90rem] mx-auto text-center">
        
        <div class="max-w-3xl mx-auto mb-24" 
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

        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 md:gap-20 items-center justify-center grayscale-grid">
            
            @foreach(range(1, 8) as $i)
                <div class="group flex justify-center items-center p-4 transition-all duration-500 hover:scale-105"
                     x-data="{ shown: false, init() { const obs = new IntersectionObserver(e => { if(e[0].isIntersecting){ setTimeout(() => this.shown = true, {{ $i * 100 }}); obs.disconnect()} }, {threshold:0.1}); obs.observe(this.$el); } }"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                    
                    @if($i == 1)
                        <img src="/images/maxsell.png" alt="Maxsell" class="h-12 md:h-16 w-auto object-contain opacity-40 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                    @else
                        <div class="h-12 md:h-16 w-full flex items-center justify-center opacity-40 group-hover:opacity-100 transition-all duration-500">
                           <span class="font-serif text-2xl text-cielo-dark italic">Partner {{ $i }}</span>
                        </div>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
</section>