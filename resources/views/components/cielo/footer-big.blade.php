<footer class="relative min-h-screen flex flex-col justify-between text-white bg-cielo-dark overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        <img src="/images/footer.jpg" 
             class="w-full h-full object-cover opacity-60 mix-blend-overlay transition-transform duration-[10s] hover:scale-105" 
             alt="Cielo Footer">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-black/40"></div>
    </div>

    <div class="flex-grow flex items-center justify-center relative z-10 px-6">
        
        <div class="text-center max-w-4xl mx-auto">
            
            <h2 class="font-serif text-5xl md:text-7xl lg:text-8xl leading-[1.1] mb-8 drop-shadow-2xl">
                {!! __('footer.title') !!}
            </h2>
            
            <p class="font-sans text-xl md:text-2xl font-light opacity-90 mb-16 max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                {{ __('footer.text') }}
            </p>
            
            <a href="{{ route('pages.contact') }}" class="group relative inline-flex items-center justify-center overflow-hidden bg-white text-cielo-dark px-12 py-5 rounded-full min-w-[240px] shadow-xl hover:shadow-2xl transition-all duration-300">
                
                <span class="font-bold text-sm uppercase tracking-[0.2em] transition-transform duration-500 ease-in-out group-hover:-translate-y-[150%]">
                    {{ __('footer.cta') }}
                </span>
                
                <span class="absolute font-bold text-sm uppercase tracking-[0.2em] transition-transform duration-500 ease-in-out translate-y-[150%] group-hover:translate-y-0 text-cielo-terracotta">
                    {{ __('footer.cta') }}
                </span>

            </a>
        </div>
    </div>

    <div class="relative z-10 border-t border-white/10 bg-black/30 backdrop-blur-md">
        <div class="max-w-[95rem] mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-8 text-xs uppercase tracking-widest font-medium text-white/70">
            
            <div class="flex items-center gap-6">
                <span class="font-serif text-2xl font-bold text-white tracking-widest">Cielo</span>
                <span class="hidden md:inline border-l border-white/20 pl-6 h-4 flex items-center">
                    © {{ date('Y') }}
                </span>
            </div>
            
            <div class="flex flex-wrap justify-center gap-8">
                <a href="{{ route('pages.contact') }}" class="hover:text-white hover:underline decoration-cielo-accent underline-offset-4 transition-all">
                    {{ __('footer.contact') }}
                </a>
                <a href="{{ route('legal.privacy') }}" class="hover:text-white hover:underline decoration-cielo-accent underline-offset-4 transition-all">
                    {{ __('footer.privacy') }}
                </a>
                <a href="{{ route('legal.terms') }}" class="hover:text-white hover:underline decoration-cielo-accent underline-offset-4 transition-all">
                    {{ __('footer.terms') }}
                </a>
            </div>

            <div class="flex items-center gap-3 opacity-60 hover:opacity-100 transition-opacity duration-300">
                <span>{{ __('footer.developed') }}</span>
                <img src="/images/maxsell.png" alt="MaxSell" class="h-6 w-auto brightness-0 invert">
            </div>

        </div>
    </div>
</footer>