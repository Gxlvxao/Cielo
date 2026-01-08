<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[50vh] min-h-[400px]">
        <img src="{{ asset('images/hero-luxury.jpg') }}" alt="About Crow Global" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-background"></div>
        <div class="absolute inset-0 flex items-center justify-center pt-20">
            <div class="text-center animate-fade-in-up">
                <span class="text-accent font-bold tracking-widest uppercase text-sm mb-4 block">{{ __('Our Story') }}</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold text-white">
                    {{ __('About Us') }}
                </h1>
            </div>
        </div>
    </div>

    {{-- CONTEÚDO PRINCIPAL --}}
    <section class="py-24 bg-background">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center max-w-7xl mx-auto">
                {{-- Texto Institucional --}}
                <div class="animate-fade-up">
                    <div class="inline-block px-4 py-1 bg-accent/10 rounded-full mb-6 border border-accent/20">
                        <span class="text-accent text-sm font-medium">{{ __('About Crow Global') }}</span>
                    </div>
                    <h2 class="font-heading text-4xl md:text-5xl font-bold mb-8 text-foreground leading-tight">
                        {{ __('Excellence in') }} <span class="text-accent">{{ __('Real Estate') }}</span>
                    </h2>
                    <div class="space-y-6 text-lg text-muted-foreground leading-relaxed">
                        <p>
                            {{ __('Crow Global Investments connects international capital to exceptional properties across Portugal, delivering a boutique consulting experience with complete transparency.') }}
                        </p>
                        <p>
                            {{ __('Our deep market knowledge, combined with exclusive access to off-market opportunities, ensures our clients discover investments that truly match their vision and financial goals.') }}
                        </p>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-3 gap-8 mt-12 border-t border-border pt-8">
                        <div class="text-center">
                            <div class="text-4xl font-heading font-bold text-accent mb-2">15+</div>
                            <div class="text-sm font-medium text-muted-foreground uppercase tracking-wide">{{ __('Years') }}</div>
                        </div>
                        <div class="text-center border-x border-border">
                            <div class="text-4xl font-heading font-bold text-accent mb-2">€500M+</div>
                            <div class="text-sm font-medium text-muted-foreground uppercase tracking-wide">{{ __('Assets') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-heading font-bold text-accent mb-2">30+</div>
                            <div class="text-sm font-medium text-muted-foreground uppercase tracking-wide">{{ __('Countries') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Imagem Destaque --}}
                <div class="relative group animate-fade-up delay-100">
                    <div class="absolute -inset-4 bg-accent/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <img
                        src="{{ asset('images/about-team.jpg') }}"
                        alt="Crow Global Team"
                        class="relative rounded-2xl shadow-2xl w-full h-[600px] object-cover grayscale group-hover:grayscale-0 transition duration-700"
                    />
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
</x-public-layout>