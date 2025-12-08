<x-public-layout>
    @include('components.header')
    
    <main>
        <div class="relative w-full h-screen">
            <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Luxury" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
                <h1 class="font-heading text-5xl md:text-7xl font-bold mb-6 animate-fade-in-up">
                    <span class="text-white">{{ __('messages.hero_title_1') }}</span>
                    <span class="text-accent">{{ __('messages.hero_title_2') }}</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 font-light tracking-wide max-w-2xl mx-auto animate-fade-in-up delay-100">
                    {{ __('messages.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up delay-200">
                    <a href="{{ route('properties.index') }}" class="bg-accent hover:bg-accent/90 text-white font-bold py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-lg">
                        {{ __('messages.explore_properties') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-bold py-3 px-8 rounded-full border border-white/30 transition-all">
                        {{ __('messages.request_access') }}
                    </a>
                </div>
            </div>
        </div>
        
        @include('components.about')
        @include('components.municipalities')
        @include('components.services')
        @include('components.off-market-cta')
    </main>
    
    @include('components.footer')
</x-public-layout>