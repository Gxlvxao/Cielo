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
            'title' => __('Acquisition (Buy-side)'),
            'description' => __('Strategic sourcing and acquisition of premium assets. We identify opportunities that align with your investment profile with total discretion.'),
            'icon' => 'search',
        ],
        [
            'title' => __('Alienation (Sell-side)'),
            'description' => __('Exclusive representation for selling your asset. We promote your property directly to our private network of qualified investors.'),
            'icon' => 'chart',
        ],
        [
            'title' => __('Confidential Mandates'),
            'description' => __('Off-market transactions where privacy is paramount. Access opportunities that never hit the public market.'),
            'icon' => 'lock',
        ],
        [
            'title' => __('Investment Consulting'),
            'description' => __('Structural advice for complex real estate operations, asset valuation, and yield maximization strategies.'),
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
                    {{ __('360º Real Estate Solutions') }}
                </h2>
                <p class="text-xl text-muted-foreground font-light">
                    {{ __('From sourcing to deal structuring, we provide a full-service approach for investors and property owners.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto mb-20">
                @foreach($services as $index => $service)
                <div class="group p-10 rounded-2xl border border-white/5 bg-card hover:bg-white/5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 animate-fade-up relative overflow-hidden"
                     style="animation-delay: {{ $index * 0.1 }}s">
                    
                    {{-- Hover Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-accent/10 flex items-center justify-center mb-8 group-hover:bg-accent group-hover:text-white transition-all duration-300 shadow-lg">
                            @if($service['icon'] === 'search')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            @elseif($service['icon'] === 'chart')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            @elseif($service['icon'] === 'lock')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
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

            {{-- CTA FINAL --}}
            <div class="text-center animate-fade-up delay-300">
                <h3 class="text-2xl font-bold mb-6 text-foreground">{{ __('Ready to discuss your investment?') }}</h3>
                <a href="{{ route('pages.contact') }}" class="inline-block bg-accent hover:bg-white hover:text-accent text-white font-bold py-4 px-10 rounded-full transition-all shadow-lg transform hover:-translate-y-1">
                    {{ __('Schedule a Meeting') }}
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</x-public-layout>