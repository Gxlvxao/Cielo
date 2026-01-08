<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[50vh] min-h-[400px]">
        <img src="{{ asset('images/hero-luxury.jpg') }}" alt="About Crow Global" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-background"></div>
        <div class="absolute inset-0 flex items-center justify-center pt-20">
            <div class="text-center animate-fade-in-up">
                <span class="text-accent font-bold tracking-widest uppercase text-sm mb-4 block">{{ __('Our Legacy') }}</span>
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
                        <span class="text-accent text-sm font-medium">{{ __('26 Years of Excellence') }}</span>
                    </div>
                    <h2 class="font-heading text-4xl md:text-5xl font-bold mb-8 text-foreground leading-tight">
                        {{ __('Experts in') }} <span class="text-accent">{{ __('Off-Market Assets') }}</span>
                    </h2>
                    
                    <div class="space-y-6 text-lg text-muted-foreground leading-relaxed">
                        <p>
                            {{ __('With over two decades of history, Crow Global Investments specializes in connecting investors to exclusive opportunities. Our positioning is defined by total discretion and confidentiality, ensuring transactions without personal exposure.') }}
                        </p>
                        <p>
                            {{ __('We operate strictly in the Buy-side and Sell-side markets for premium assets, including:') }}
                        </p>
                        
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Development Land') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Hotels & Resorts') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Private Condominiums') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Approved Projects') }}
                            </li>
                        </ul>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-3 gap-8 mt-12 border-t border-border pt-8">
                        <div class="text-center">
                            <div class="text-4xl font-heading font-bold text-accent mb-2">26</div>
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