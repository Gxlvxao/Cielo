<x-site-layout>
    
    {{-- 1. INTRODUÇÃO (Baseado no layout da página About) --}}
    <section class="bg-white pt-48 pb-24 px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center md:text-left">
            
            {{-- Label estilo About --}}
            <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-8 block">
                Rede Global
            </span>

            {{-- Título Principal estilo About --}}
            <h1 class="font-serif text-4xl md:text-6xl lg:text-7xl leading-tight text-cielo-dark mb-12">
                Conexões que
                <span class="text-cielo-terracotta/80 italic">transcendem fronteiras.</span>
            </h1>

            {{-- Texto de Apoio estilo About --}}
            <p class="font-inter font-light text-lg md:text-xl text-cielo-navy/70 leading-relaxed max-w-2xl">
                A nossa força reside nas nossas parcerias. Unimo-nos às marcas mais prestigiadas do imobiliário mundial para oferecer ao seu ativo uma exposição incomparável.
            </p>

        </div>
    </section>

    {{-- 2. PARCEIRO 1: SOTHEBY'S (Dobra Imponente) --}}
    <section class="relative py-24 px-6 bg-gray-50 overflow-hidden">
        <div class="max-w-[90rem] mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                
                {{-- Imagem (Lado Esquerdo) --}}
                <div class="w-full md:w-1/2 relative group">
                    <div class="aspect-[4/3] overflow-hidden rounded-sm">
                        <img src="/images/lisboa.jpg" alt="Sotheby's International Realty" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    </div>
                    {{-- Elemento decorativo --}}
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cielo-terracotta/10 rounded-full blur-2xl"></div>
                </div>

                {{-- Texto (Lado Direito) --}}
                <div class="w-full md:w-1/2 space-y-8">
                    {{-- Logo Parceiro --}}
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Sotheby%27s_International_Realty_logo.svg/2560px-Sotheby%27s_International_Realty_logo.svg.png" 
                         alt="Sotheby's Logo" 
                         class="h-12 lg:h-16 object-contain opacity-80">

                    <h2 class="font-serif text-3xl md:text-4xl text-cielo-dark">
                        O padrão ouro do luxo.
                    </h2>
                    
                    <p class="font-inter font-light text-lg text-cielo-navy/70 leading-relaxed">
                        Como parceiros da rede Sotheby's International Realty, conectamos a sua propriedade aos compradores mais qualificados do mundo, combinando tradição centenária com inovação em marketing.
                    </p>

                    <div class="pt-4">
                        <span class="inline-block py-2 px-0 border-b border-cielo-dark text-xs font-bold tracking-[0.2em] uppercase text-cielo-dark">
                            Alcance Global
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. PARCEIRO 2: CHRISTIE'S (Invertido / Zig-Zag) --}}
    <section class="relative py-24 px-6 bg-white overflow-hidden">
        <div class="max-w-[90rem] mx-auto">
            <div class="flex flex-col md:flex-row-reverse items-center gap-16 lg:gap-24">
                
                {{-- Imagem (Lado Direito no Desktop) --}}
                <div class="w-full md:w-1/2 relative group">
                    <div class="aspect-[4/3] overflow-hidden rounded-sm">
                        <img src="/images/porto.jpg" alt="Christie's International" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    </div>
                </div>

                {{-- Texto (Lado Esquerdo) --}}
                <div class="w-full md:w-1/2 space-y-8 md:text-right">
                    {{-- Logo Parceiro (Alinhado à direita no desktop) --}}
                    <div class="flex md:justify-end">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/23/Christies_logo_black.png" 
                             alt="Christie's Logo" 
                             class="h-10 lg:h-12 object-contain opacity-80">
                    </div>

                    <h2 class="font-serif text-3xl md:text-4xl text-cielo-dark">
                        Arte de viver.
                    </h2>
                    
                    <p class="font-inter font-light text-lg text-cielo-navy/70 leading-relaxed">
                        Especialistas em propriedades que são verdadeiras obras de arte. A nossa afiliação com a Christie's permite o acesso a uma clientela exclusiva de colecionadores e investidores internacionais.
                    </p>

                    <div class="pt-4 flex md:justify-end">
                        <span class="inline-block py-2 px-0 border-b border-cielo-dark text-xs font-bold tracking-[0.2em] uppercase text-cielo-dark">
                            Exclusividade
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. PARCEIRO TECH: MAXSELL (Último, com destaque diferenciado) --}}
    <section class="relative py-32 px-6 bg-cielo-dark text-white overflow-hidden">
        {{-- Background sutil --}}
        <div class="absolute inset-0 opacity-20">
            <img src="/images/footer.jpg" class="w-full h-full object-cover" alt="Background">
        </div>
        
        <div class="max-w-5xl mx-auto text-center relative z-10">
            
            <div class="mb-12 flex justify-center">
                <div class="bg-white/10 p-6 rounded-full backdrop-blur-sm border border-white/10">
                    <img src="/images/maxsell.png" alt="MaxSell" class="h-12 lg:h-16 w-auto brightness-0 invert object-contain">
                </div>
            </div>

            <h2 class="font-serif text-4xl md:text-6xl mb-8">
                Inteligência de Dados & Tecnologia
            </h2>

            <p class="font-inter font-light text-lg md:text-xl text-white/70 leading-relaxed max-w-3xl mx-auto mb-12">
                A MaxSell é o nosso parceiro estratégico de tecnologia. Utilizamos algoritmos avançados e análise preditiva para identificar o valor real do seu imóvel e encontrar o comprador certo no momento exato.
            </p>

            <a href="#" class="inline-flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-cielo-terracotta hover:text-white transition-colors group">
                Conheça a Tecnologia
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>

        </div>
    </section>

    <x-cielo.footer-big />

</x-site-layout>