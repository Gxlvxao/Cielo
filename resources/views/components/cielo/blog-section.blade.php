@props(['posts'])

@php
    // Separa o primeiro post (Destaque) dos outros 3
    $featured = $posts->first(); 
    $others = $posts->skip(1);
@endphp

<section class="bg-white py-32 px-6 relative z-20 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        <div class="flex justify-between items-end mb-20 border-b border-cielo-dark/10 pb-8">
            <h2 class="font-serif text-5xl md:text-6xl text-cielo-dark">
                {{ __('home.blog.label') }}
            </h2>
            <a href="{{ route('blog.index') }}" class="hidden md:inline-block text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                {{ __('home.blog.view_all') }} →
            </a>
        </div>

        @if($featured)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24 group cursor-pointer" 
                 onclick="window.location='{{ route('blog.show', $featured->slug) }}'">
                
                <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col justify-center pr-8">
                    <div class="flex items-center gap-4 mb-6 text-xs font-bold uppercase tracking-widest">
                        <span class="text-cielo-terracotta">{{ $featured->category }}</span>
                        <span class="w-1 h-1 bg-cielo-dark/30 rounded-full"></span>
                        <span class="text-cielo-navy/60">{{ $featured->created_at->format('M d, Y') }}</span>
                    </div>

                    <h3 class="font-serif text-4xl md:text-5xl text-cielo-dark italic leading-[1.1] mb-6 group-hover:text-cielo-terracotta transition-colors duration-300">
                        {{ $featured->title }}
                    </h3>

                    <p class="font-sans text-lg text-cielo-navy/70 leading-relaxed mb-8 line-clamp-3">
                        {{ $featured->summary }}
                    </p>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200">
                            <img src="{{ $featured->user->profile_photo_url ?? '/images/about-team.jpg' }}" alt="Author" class="w-full h-full object-cover">
                        </div>
                        <div class="text-sm">
                            <p class="font-bold text-cielo-dark">{{ $featured->user->name ?? 'Cielo Team' }}</p>
                            <p class="text-xs text-cielo-navy/50 uppercase tracking-widest">Editor</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 order-1 lg:order-2 relative overflow-hidden aspect-[4/3] lg:aspect-[16/10]">
                    <img src="{{ Storage::url($featured->cover_image) }}" 
                         alt="{{ $featured->title }}" 
                         class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-cielo-dark/10 pt-16">
                @foreach($others as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                        <div class="overflow-hidden aspect-[4/3] mb-6 bg-gray-100 relative">
                            <img src="{{ Storage::url($post->cover_image) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 alt="{{ $post->title }}">
                        </div>

                        <div class="flex flex-col h-full justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-terracotta mb-3 block">
                                    {{ $post->category }}
                                </span>
                                <h4 class="font-serif text-2xl text-cielo-dark mb-4 leading-tight group-hover:text-cielo-terracotta transition-colors">
                                    {{ $post->title }}
                                </h4>
                            </div>
                            <div class="mt-2 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-cielo-navy/50 font-medium">
                                <span>{{ $post->created_at->format('M d') }}</span>
                                <span class="group-hover:translate-x-2 transition-transform duration-300 text-cielo-dark">Read →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24 group cursor-pointer">
                <div class="lg:col-span-5 order-2 lg:order-1 pr-8">
                    <div class="flex items-center gap-4 mb-6 text-xs font-bold uppercase tracking-widest">
                        <span class="text-cielo-terracotta">Feng Shui</span>
                        <span class="text-cielo-navy/60">6 {{ __('home.blog.min_read') }}</span>
                    </div>
                    <h3 class="font-serif text-4xl md:text-5xl text-cielo-dark italic leading-[1.1] mb-6 group-hover:text-cielo-terracotta transition-colors">
                        Feng Shui at Home: Simple, Practical Measures to Improve Energy
                    </h3>
                    <p class="font-sans text-lg text-cielo-navy/70 leading-relaxed mb-8">
                        In luxury real estate, true value goes beyond location and finishes. It is also about how a home feels to live in.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="/images/about-team.jpg" alt="Author" class="w-12 h-12 rounded-full object-cover grayscale">
                        <div class="text-sm">
                            <p class="font-bold text-cielo-dark">Isabel Matos</p>
                            <p class="text-xs text-cielo-navy/50 uppercase tracking-widest">Specialist</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 order-1 lg:order-2 relative overflow-hidden aspect-[16/10] bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=1200" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-cielo-dark/10 pt-16 opacity-60">
                @foreach(['Lisbon Market Trends 2026', 'The Art of Slow Living', 'Golden Visa Updates'] as $index => $title)
                    <div class="group cursor-pointer">
                        <div class="overflow-hidden aspect-[4/3] mb-6 bg-gray-100">
                            <img src="https://images.unsplash.com/photo-{{ 1600000000000 + $index }}?q=80&w=600&auto=format&fit=crop" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105" 
                                 alt="Placeholder">
                        </div>

                        <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-terracotta mb-3 block">Market Analysis</span>
                        <h4 class="font-serif text-2xl text-cielo-dark mb-4 leading-tight group-hover:text-cielo-terracotta transition-colors">{{ $title }}</h4>
                        <div class="mt-2 pt-4 border-t border-gray-100 text-xs text-cielo-navy/50">Read Story →</div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-16 text-center md:hidden">
            <a href="{{ route('blog.index') }}" class="inline-block border border-cielo-dark px-8 py-3 text-xs font-bold uppercase tracking-widest">
                {{ __('home.blog.view_all') }}
            </a>
        </div>

    </div>
</section>