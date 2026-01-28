<section class="py-24 md:py-32 bg-gray-50 overflow-hidden"
         x-data="{
             scroll: 0,
             maxScroll: 0,
             updateScroll() {
                 const container = this.$refs.scrollContainer;
                 if(container) {
                    this.maxScroll = container.scrollWidth - container.clientWidth;
                 }
             },
             slide(direction) {
                 const container = this.$refs.scrollContainer;
                 if(container) {
                     const amount = direction === 'next' ? 350 : -350;
                     container.scrollBy({ left: amount, behavior: 'smooth' });
                 }
             }
         }"
         x-init="updateScroll(); window.addEventListener('resize', () => updateScroll())"
>
    
    {{-- HEADER (Alinhado com Container Global) --}}
    <div class="container mx-auto px-6 mb-16 flex flex-col md:flex-row items-end justify-between gap-8">
        <div class="max-w-xl">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-cielo-terracotta block mb-4">
                {{ __('testimonials.label') }}
            </span>
            <h2 class="font-display text-4xl md:text-5xl text-cielo-dark leading-none">
                {!! __('testimonials.title') !!}
            </h2>
        </div>

        {{-- CONTROLES --}}
        <div class="flex gap-4">
            <button @click="slide('prev')" 
                    class="w-12 h-12 rounded-full border border-cielo-dark/10 flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-all duration-300 group">
                <span class="text-xl group-hover:-translate-x-0.5 transition-transform">←</span>
            </button>
            <button @click="slide('next')" 
                    class="w-12 h-12 rounded-full border border-cielo-dark/10 flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-all duration-300 group">
                <span class="text-xl group-hover:translate-x-0.5 transition-transform">→</span>
            </button>
        </div>
    </div>

    {{-- 
        CAROUSEL
        Ajuste do cálculo: Usando 1440px (90rem) para alinhar com o featured-properties.
        pl-[max(1.5rem,...)] garante que em telas menores mantenha o padding padrão (px-6).
    --}}
    <div class="pl-6 md:pl-[max(1.5rem,calc((100vw-1440px)/2+1.5rem))]">
        
        <div x-ref="scrollContainer" 
             class="flex gap-6 md:gap-8 overflow-x-auto pb-12 snap-x snap-mandatory hide-scrollbar cursor-grab active:cursor-grabbing pr-6 md:pr-32"
             style="scrollbar-width: none; -ms-overflow-style: none;">

            @php
                $stories = [
                    [
                        'name' => 'Família Schneider',
                        'location' => 'Grande Lisboa',
                        'quote_key' => 'testimonials.review_1',
                        'video' => 'https://videos.pexels.com/video-files/3252009/3252009-hd_1080_1920_25fps.mp4', 
                        'cover' => 'https://images.pexels.com/photos/3771691/pexels-photo-3771691.jpeg?auto=compress&cs=tinysrgb&w=800'
                    ],
                    [
                        'name' => 'Marc & Antoine',
                        'location' => 'Grande Porto',
                        'quote_key' => 'testimonials.review_2',
                        'video' => 'https://videos.pexels.com/video-files/4944866/4944866-hd_1080_1920_30fps.mp4',
                        'cover' => 'https://images.pexels.com/photos/3760263/pexels-photo-3760263.jpeg?auto=compress&cs=tinysrgb&w=800'
                    ],
                    [
                        'name' => 'Sarah Jenkins',
                        'location' => 'Algarve',
                        'quote_key' => 'testimonials.review_3',
                        'video' => 'https://videos.pexels.com/video-files/5900569/5900569-hd_1080_1920_25fps.mp4',
                        'cover' => 'https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=800'
                    ],
                    [
                        'name' => 'Ricardo Silva',
                        'location' => 'Cascais, Grande Lisboa',
                        'quote_key' => 'testimonials.review_4',
                        'video' => 'https://videos.pexels.com/video-files/3196068/3196068-hd_1080_1920_25fps.mp4',
                        'cover' => 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=800'
                    ],
                     [
                        'name' => 'Elena & Grigory',
                        'location' => 'Ilha da Madeira',
                        'quote_key' => 'testimonials.review_5',
                        'video' => 'https://videos.pexels.com/video-files/4435749/4435749-hd_1080_1920_30fps.mp4',
                        'cover' => 'https://images.pexels.com/photos/1036623/pexels-photo-1036623.jpeg?auto=compress&cs=tinysrgb&w=800'
                    ],
                ];
            @endphp

            @foreach($stories as $item)
                {{-- CARD --}}
                <div class="relative flex-none w-[280px] md:w-[320px] aspect-[9/16] snap-start group rounded-2xl overflow-hidden bg-gray-200 shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
                    
                    {{-- Vídeo Background --}}
                    <div class="absolute inset-0 w-full h-full">
                        <img src="{{ $item['cover'] }}" 
                             alt="{{ $item['name'] }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out z-10 filter grayscale group-hover:grayscale-0 group-hover:opacity-0">
                        
                        <video class="absolute inset-0 w-full h-full object-cover z-0" 
                               muted loop playsinline preload="none"
                               onmouseover="this.play()" 
                               onmouseout="this.pause();">
                            <source src="{{ $item['video'] }}" type="video/mp4">
                        </video>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-20 opacity-90 group-hover:opacity-70 transition-opacity duration-500"></div>
                    </div>

                    {{-- Conteúdo --}}
                    <div class="absolute bottom-0 left-0 w-full p-8 z-30 text-white transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-6 opacity-0 group-hover:opacity-100 transition-all duration-500 -translate-y-4 group-hover:translate-y-0">
                            <svg class="w-4 h-4 text-white fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>

                        {{-- Citação Traduzida --}}
                        <p class="font-display text-xl leading-snug mb-4 text-gray-100 group-hover:text-white transition-colors">
                            "{{ __($item['quote_key']) }}"
                        </p>

                        <div class="border-t border-white/20 pt-4 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-sm tracking-wide text-cielo-cream">{{ $item['name'] }}</h4>
                                <p class="text-[10px] uppercase tracking-widest opacity-70 mt-1">{{ $item['location'] }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

            {{-- Espaçador final --}}
            <div class="w-6 md:w-32 flex-none"></div>
        </div>
    </div>

</section>