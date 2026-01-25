<x-site-layout>
    
    {{-- 1. INTRODUÇÃO --}}
    <section class="bg-white pt-48 pb-16 px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center md:text-left">
            
            {{-- Label --}}
            <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-8 block">
                {{ __('partners.label') }}
            </span>

            {{-- Título --}}
            <h1 class="font-serif text-4xl md:text-6xl lg:text-7xl leading-tight text-cielo-dark mb-12">
                {{ __('partners.hero_title_1') }}
                <span class="text-cielo-terracotta/80 italic">{{ __('partners.hero_title_2') }}</span>
            </h1>

            {{-- Texto --}}
            <p class="font-inter font-light text-lg md:text-xl text-cielo-navy/70 leading-relaxed max-w-2xl">
                {{ __('partners.hero_text') }}
            </p>

        </div>
    </section>

    {{-- 2. LISTA GERAL DE PARCEIROS (Componente Solicitado) --}}
    <div class="pb-24">
        <x-cielo.partners-section />
    </div>

    {{-- 3. PARCEIRO 1: SOTHEBY'S --}}
    <section class="relative py-24 px-6 bg-gray-50 overflow-hidden">
        <div class="max-w-[90rem] mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                
                {{-- Imagem --}}
                <div class="w-full md:w-1/2 relative group">
                    <div class="aspect-[4/3] overflow-hidden rounded-sm">
                        <img src="/images/lisboa.jpg" alt="Sotheby's International Realty" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-cielo-terracotta/10 rounded-full blur-2xl"></div>
                </div>

                {{-- Texto --}}
                <div class="w-full md:w-1/2 space-y-8">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Sotheby%27s_International_Realty_logo.svg/2560px-Sotheby%27s_International_Realty_logo.svg.png" 
                         alt="Sotheby's Logo" 
                         class="h-12 lg:h-16 object-contain opacity-80">

                    <h2 class="font-serif text-3xl md:text-4xl text-cielo-dark">
                        {{ __('partners.sothebys_title') }}
                    </h2>
                    
                    <p class="font-inter font-light text-lg text-cielo-navy/70 leading-relaxed">
                        {{ __('partners.sothebys_text') }}
                    </p>

                    <div class="pt-4">
                        <span class="inline-block py-2 px-0 border-b border-cielo-dark text-xs font-bold tracking-[0.2em] uppercase text-cielo-dark">
                            {{ __('partners.global_reach') }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. PARCEIRO 2: CHRISTIE'S --}}
    <section class="relative py-24 px-6 bg-white overflow-hidden">
        <div class="max-w-[90rem] mx-auto">
            <div class="flex flex-col md:flex-row-reverse items-center gap-16 lg:gap-24">
                
                {{-- Imagem --}}
                <div class="w-full md:w-1/2 relative group">
                    <div class="aspect-[4/3] overflow-hidden rounded-sm">
                        <img src="/images/porto.jpg" alt="Christie's International" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    </div>
                </div>

                {{-- Texto --}}
                <div class="w-full md:w-1/2 space-y-8 md:text-right">
                    <div class="flex md:justify-end">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/23/Christies_logo_black.png" 
                             alt="Christie's Logo" 
                             class="h-10 lg:h-12 object-contain opacity-80">
                    </div>

                    <h2 class="font-serif text-3xl md:text-4xl text-cielo-dark">
                        {{ __('partners.christies_title') }}
                    </h2>
                    
                    <p class="font-inter font-light text-lg text-cielo-navy/70 leading-relaxed">
                        {{ __('partners.christies_text') }}
                    </p>

                    <div class="pt-4 flex md:justify-end">
                        <span class="inline-block py-2 px-0 border-b border-cielo-dark text-xs font-bold tracking-[0.2em] uppercase text-cielo-dark">
                            {{ __('partners.exclusivity') }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-cielo.footer-big />

</x-site-layout>