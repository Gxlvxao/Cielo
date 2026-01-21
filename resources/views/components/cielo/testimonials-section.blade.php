<section class="bg-cielo-cream py-32 relative z-20 border-b border-gray-100 overflow-hidden">
    <div class="max-w-[95rem] mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div class="max-w-2xl">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block">
                    {{ __('home.testimonials.label') }}
                </span>
                <h2 class="font-serif text-5xl md:text-6xl text-cielo-dark leading-tight">
                    {!! __('home.testimonials.title') !!}
                </h2>
            </div>

            <div class="flex gap-4">
                <button @click="$refs.scroller.scrollBy({ left: -400, behavior: 'smooth' })" 
                        class="w-14 h-14 border border-cielo-dark rounded-full flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-all duration-300 group">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="$refs.scroller.scrollBy({ left: 400, behavior: 'smooth' })" 
                        class="w-14 h-14 border border-cielo-dark rounded-full flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-all duration-300 group">
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <div x-data="{}" 
             x-ref="scroller"
             class="flex gap-8 overflow-x-auto pb-20 pt-10 px-4 no-scrollbar snap-x snap-mandatory scroll-pl-6">
            
            @foreach(range(1, 5) as $i)
                <div class="relative flex-none w-[300px] md:w-[400px] aspect-[3/4] snap-center group perspective-1000 cursor-pointer">
                    
                    <div class="w-full h-full bg-black rounded-xl overflow-hidden shadow-lg relative transform transition-all duration-700 ease-out
                                scale-95 opacity-80 blur-[1px] rotate-2 translate-y-4
                                group-hover:scale-105 group-hover:opacity-100 group-hover:blur-0 group-hover:rotate-0 group-hover:translate-y-0 group-hover:shadow-2xl group-hover:z-20">
                        
                        <video class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500" 
                               loop muted playsinline poster="/images/hero-luxury.jpg">
                            <source src="/videos/testimonial-{{ $i }}.mp4" type="video/mp4">
                        </video>
                        
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-500"></div>

                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 transform transition-all duration-500 group-hover:scale-110 group-hover:bg-white/30">
                                <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>

                        <div class="absolute bottom-0 left-0 w-full p-8 bg-gradient-to-t from-black/90 via-black/50 to-transparent transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <p class="text-white/90 font-serif italic text-lg mb-2 leading-relaxed line-clamp-3">
                                "{{ __("home.testimonials.$i.desc") }}"
                            </p>
                            <div class="flex items-center gap-3 mt-4 border-t border-white/20 pt-4">
                                <div class="w-8 h-8 rounded-full bg-cielo-accent flex items-center justify-center text-xs font-bold text-cielo-dark">
                                    {{ substr(__("home.testimonials.$i.author"), 0, 1) }}
                                </div>
                                <span class="text-xs font-bold uppercase tracking-widest text-white/80">
                                    {{ __("home.testimonials.$i.author") }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            <div class="w-12 flex-none"></div>
        </div>

    </div>
</section>