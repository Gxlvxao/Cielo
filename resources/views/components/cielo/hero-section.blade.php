<div class="fixed inset-0 w-full h-screen z-0 overflow-hidden bg-cielo-dark">
    
    {{-- Background Image --}}
    <img src="{{ asset('images/fotoheader.jpg') }}" 
         alt="Cielo Hero Background" 
         class="absolute w-full h-full object-cover opacity-80">

    {{-- Overlays (Gradientes) --}}
    <div class="absolute inset-0 bg-gradient-to-r from-cielo-dark/80 via-cielo-dark/40 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-cielo-dark/70 via-transparent to-transparent"></div>

    {{-- Conteúdo Principal --}}
    <div class="absolute inset-0 flex flex-col justify-center md:justify-end pb-32 pl-24 pr-6 md:pl-44 md:pr-16 z-10 pointer-events-none">
        
        <div x-data="{ shown: false }" 
             x-init="setTimeout(() => shown = true, 500)" 
             class="max-w-4xl text-left text-white">
            
            {{-- LOGO CIELO (Adicionado) --}}
            <img x-show="shown"
                 src="{{ asset('images/cielo.png') }}"
                 alt="Cielo Logo"
                 x-transition:enter="transition duration-[1500ms] ease-out"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-10 md:h-14 w-auto mb-8 drop-shadow-xl brightness-0 invert" {{-- brightness/invert para garantir que fique branco sobre o fundo --}}
            >

            {{-- Título Principal --}}
            <h1 x-show="shown"
                x-transition:enter="transition duration-[1500ms] delay-200 ease-out"
                x-transition:enter-start="opacity-0 translate-y-12 blur-sm"
                x-transition:enter-end="opacity-100 translate-y-0 blur-0"
                class="font-display text-3xl md:text-5xl lg:text-6xl leading-tight mb-5 drop-shadow-lg tracking-widest uppercase">
                {!! __('home.hero.title') !!}
            </h1>

            {{-- Linha Decorativa --}}
            <div x-show="shown"
                 x-transition:enter="transition duration-[1000ms] delay-500 ease-out"
                 x-transition:enter-start="opacity-0 w-0"
                 x-transition:enter-end="opacity-100 w-20"
                 class="h-0.5 bg-[#C9A35E] mb-6 shadow-sm"></div>

            {{-- Subtítulo --}}
            <p x-show="shown"
               x-transition:enter="transition duration-[1500ms] delay-700 ease-out"
               x-transition:enter-start="opacity-0 translate-y-8"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="font-sans text-base md:text-lg font-light leading-relaxed tracking-wide opacity-90 max-w-lg drop-shadow-md text-cielo-cream">
                {{ __('home.hero.subtitle') }}
            </p>

        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce text-white/60 z-20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>