@props(['properties'])

<section class="bg-white py-32 px-6 relative z-10 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
            <div class="max-w-2xl">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block">
                    {{ __('home.properties.label') }}
                </span>
                <h2 class="font-serif text-5xl md:text-7xl text-cielo-dark leading-[1.1]">
                    {!! __('home.properties.title') !!}
                </h2>
            </div>

            <div class="hidden md:block pb-2">
                <a href="{{ route('properties.index') }}" class="group relative inline-block overflow-hidden h-6 text-sm font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                    
                    <span class="block transition-transform duration-500 ease-in-out group-hover:-translate-y-full">
                        {{ __('home.properties.view_all') }}
                    </span>
                    
                    <span class="block absolute top-0 left-0 w-full transition-transform duration-500 ease-in-out translate-y-full group-hover:translate-y-0">
                        {{ __('home.properties.view_all') }}
                    </span>

                    <span class="absolute bottom-0 left-0 w-full h-px bg-current transform scale-x-100 group-hover:scale-x-0 transition-transform duration-500 origin-right"></span>
                    <span class="absolute bottom-0 left-0 w-full h-px bg-cielo-terracotta transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left delay-100"></span>
                </a>
            </div>
        </div>

        <div class="space-y-32">
            @foreach($properties->take(3) as $property)
                <div class="group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-end" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                    
                    <div class="lg:col-span-10 relative overflow-hidden aspect-[16/10] bg-gray-100">
                        <a href="{{ route('properties.show', $property) }}" class="block w-full h-full">
                            <div class="w-full h-full overflow-hidden">
                                <img src="{{ Storage::url($property->cover_image) }}" 
                                     class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" 
                                     alt="{{ $property->title }}">
                            </div>
                        </a>
                        
                        @if($property->is_exclusive)
                            <div class="absolute top-8 left-8 bg-white/90 backdrop-blur-md text-cielo-dark px-4 py-2 text-[10px] font-bold uppercase tracking-widest z-10">
                                Off-Market
                            </div>
                        @endif
                    </div>

                    <div class="lg:col-span-2 lg:h-full flex flex-col justify-end pb-4 border-b border-cielo-dark/10 lg:border-none">
                        
                        <span class="hidden lg:block text-8xl font-serif text-gray-100 absolute -top-12 -right-12 leading-none select-none z-0 transition-colors duration-500 group-hover:text-cielo-terracotta/10">
                            0{{ $loop->iteration }}
                        </span>
                        
                        <div class="relative z-10">
                            <h3 class="font-serif text-3xl text-cielo-dark italic mb-3 leading-tight group-hover:text-cielo-terracotta transition-colors duration-300">
                                {{ $property->title }}
                            </h3>
                            
                            <p class="text-xs font-bold uppercase tracking-widest text-cielo-navy/60 mb-6">
                                {{ $property->city }}
                                @if($property->district) • {{ $property->district }} @endif
                            </p>
                            
                            <div class="text-lg font-medium text-cielo-dark mb-8">
                                {{ $property->formatted_price }}
                            </div>

                            <a href="{{ route('properties.show', $property) }}" class="inline-flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors group/btn">
                                {{ __('properties.view_btn') ?? 'View Home' }}
                                <span class="text-xl transition-transform duration-300 group-hover/btn:translate-x-2">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-20 text-center md:hidden">
            <a href="{{ route('properties.index') }}" class="inline-block border border-cielo-dark text-cielo-dark px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-cielo-dark hover:text-white transition-colors">
                {{ __('home.properties.view_all') }}
            </a>
        </div>

    </div>
</section>