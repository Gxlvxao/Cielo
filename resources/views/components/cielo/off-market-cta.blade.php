<section class="relative py-24 bg-cielo-dark overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10 mix-blend-overlay">
        {{-- Se tiver uma imagem de textura, pode por aqui. Se não, o fundo dark sólido já fica elegante --}}
        <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Background" class="w-full h-full object-cover grayscale">
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 text-center z-10">
        <span class="block text-xs font-bold uppercase tracking-[0.2em] text-cielo-terracotta mb-4">
            Exclusive Access
        </span>
        
        <h2 class="font-serif text-3xl md:text-5xl text-white mb-6">
            Collection Privée
        </h2>
        
        <p class="font-inter font-light text-white/70 max-w-2xl mx-auto mb-10 text-lg leading-relaxed">
            Tenha acesso à nossa carteira de imóveis off-market. Oportunidades de investimento selecionadas e disponíveis apenas para membros aprovados.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            {{-- Botão Principal --}}
            <a href="{{ route('pages.contact') }}" class="group relative px-8 py-4 bg-cielo-terracotta overflow-hidden">
                <div class="absolute inset-0 w-full h-full bg-white transform translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-out"></div>
                <span class="relative text-xs font-bold uppercase tracking-widest text-white group-hover:text-cielo-dark transition-colors duration-300">
                    Solicitar Acesso
                </span>
            </a>

            {{-- Botão Secundário --}}
            <a href="{{ route('properties.index') }}" class="group px-8 py-4 border border-white/20 hover:bg-white hover:border-white transition-all duration-500">
                <span class="text-xs font-bold uppercase tracking-widest text-white group-hover:text-cielo-dark transition-colors">
                    Explorar Portfolio
                </span>
            </a>
        </div>
    </div>
</section>