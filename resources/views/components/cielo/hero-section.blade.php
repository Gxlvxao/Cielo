<div class="fixed inset-0 w-full h-screen z-0 overflow-hidden bg-cielo-dark">
    
    {{-- Background Image --}}
    <img src="{{ asset('images/fotoheader.jpg') }}" 
         alt="Cielo Hero Background" 
         class="absolute w-full h-full object-cover opacity-80">

    {{-- Overlays (Gradientes para leitura do texto) --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

    {{-- REMOVIDO: Título "Cielo" do topo --}}

    {{-- Conteúdo Principal --}}
    <div class="absolute inset-0 flex flex-col justify-end pb-32 px-6 md:px-16 z-10 pointer-events-none">
        
        <div x-data="{ shown: false }" 
             x-init="setTimeout(() => shown = true, 500)" 
             class="max-w-4xl text-left text-white">
            
            <h1 x-show="shown"
                x-transition:enter="transition duration-[1500ms] ease-out"
                x-transition:enter-start="opacity-0 translate-y-12 blur-sm"
                x-transition:enter-end="opacity-100 translate-y-0 blur-0"
                class="font-serif italic text-5xl md:text-7xl lg:text-8xl leading-[1.1] mb-6 drop-shadow-lg text-shadow-sm">
                {!! __('home.hero.title') !!}
            </h1>

            <div x-show="shown"
                 x-transition:enter="transition duration-[1000ms] delay-500 ease-out"
                 x-transition:enter-start="opacity-0 w-0"
                 x-transition:enter-end="opacity-100 w-24"
                 class="h-1 bg-[#C9A35E] mb-6"></div>

            {{-- Subtítulo com Fonte INTER --}}
            <p x-show="shown"
               x-transition:enter="transition duration-[1500ms] delay-700 ease-out"
               x-transition:enter-start="opacity-0 translate-y-8"
               x-transition:enter-end="opacity-100 translate-y-0"
               style="font-family: 'Inter', sans-serif;" 
               class="text-lg md:text-xl leading-relaxed tracking-wide opacity-90 max-w-xl drop-shadow-md">
                {{ __('home.hero.subtitle') }}
            </p>

        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce text-white/80 z-20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</div>