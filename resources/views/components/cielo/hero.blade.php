@props(['videoUrl' => null, 'title' => 'Harmonia em cada detalhe', 'subtitle' => 'Curadoria imobiliária exclusiva'])

<div class="relative h-screen w-full overflow-hidden">
    <div class="fixed top-0 left-0 w-full h-full -z-10">
        @if($videoUrl)
            <video autoplay loop muted playsinline class="object-cover w-full h-full brightness-75">
                <source src="{{ $videoUrl }}" type="video/mp4">
            </video>
        @else
            <div class="w-full h-full bg-stone-900 flex items-center justify-center">
                <img src="/images/hero-luxury.jpg" class="object-cover w-full h-full opacity-60" alt="Cielo Background">
            </div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-stone-900/30"></div>
    </div>

    <div class="relative z-0 flex flex-col items-center justify-center h-full text-center px-4">
        
        <div class="space-y-6 animate-fade-in-up">
            <h2 class="text-stone-200 tracking-[0.2em] text-sm uppercase font-light">
                {{ $subtitle }}
            </h2>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl text-white font-serif italic leading-tight">
                {{ $title }}
            </h1>

            <div class="w-24 h-[1px] bg-white/50 mx-auto mt-8"></div>
        </div>

        <div class="absolute bottom-12 animate-bounce">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</div>