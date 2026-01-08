<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[50vh] min-h-[400px]">
        <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Services" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-background"></div>
        <div class="absolute inset-0 flex items-center justify-center pt-20">
            <div class="text-center animate-fade-in-up">
                <span class="text-accent font-bold tracking-widest uppercase text-sm mb-4 block">{{ __('What we do') }}</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold text-white">
                    {{ __('Our Services') }}
                </h1>
            </div>
        </div>
    </div>

    @php
    $services = [
        [
            'title' => __('Investment Consulting'),
            'description' => __('Strategic guidance to identify and acquire premium properties that align with your investment goals and risk profile.'),
            'icon' => 'building',
        ],
        [
            'title' => __('Relocation Services'),
            'description' => __('Comprehensive support for families and professionals relocating to Portugal, from visas to lifestyle integration.'),
            'icon' => 'user-check',
        ],
        [
            'title' => __('International Portfolio'),
            'description' => __('Access to exclusive off-market opportunities across Portugal\'s most desirable locations and emerging markets.'),
            'icon' => 'globe',
        ],
        [
            'title' => __('Family Office Solutions'),
            'description' => __('Bespoke wealth management and real estate services for high-net-worth individuals and family offices.'),
            'icon' => 'briefcase',
        ],
    ];
    @endphp

    <section class="py-24 bg-background relative overflow-hidden">
        {{-- Elemento decorativo de fundo --}}
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-accent/50 to-transparent"></div>

        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-20 animate-fade-up">
                <h2 class="font-heading text-4xl md:text-5xl font-bold mb-6 text-foreground">
                    {{ __('Boutique Consulting Excellence') }}
                </h2>
                <p class="text-xl text-muted-foreground font-light">
                    {{ __('Personalized service, complete transparency, and exclusive access to premium opportunities.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @foreach($services as $index => $service)
                <div class="group p-10 rounded-2xl border border-white/5 bg-card hover:bg-white/5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 animate-fade-up relative overflow-hidden"
                     style="animation-delay: {{ $index * 0.1 }}s">
                    
                    {{-- Hover Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-accent/10 flex items-center justify-center mb-8 group-hover:bg-accent group-hover:text-white transition-all duration-300 shadow-lg">
                            @if($service['icon'] === 'building')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            @elseif($service['icon'] === 'user-check')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            @elseif($service['icon'] === 'globe')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        <h3 class="font-heading text-2xl font-bold mb-4 text-foreground group-hover:text-accent transition-colors">
                            {{ $service['title'] }}
                        </h3>
                        <p class="text-muted-foreground leading-relaxed text-lg">
                            {{ $service['description'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('components.footer')
</x-public-layout>