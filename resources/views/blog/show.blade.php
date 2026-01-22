<x-cielo-layout>

    <main class="pt-32 pb-24 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            
            {{-- 1. BREADCRUMBS --}}
            <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-cielo-navy/40 mb-12">
                <a href="{{ route('home') }}" class="hover:text-cielo-terracotta transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-cielo-terracotta transition-colors">{{ __('nav.journal') }}</a>
                <span>/</span>
                <span class="text-cielo-dark line-clamp-1">{{ $post->title }}</span>
            </div>

            {{-- 2. CABEÇALHO DO ARTIGO --}}
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <span class="px-3 py-1 border border-cielo-dark/10 text-[10px] font-bold uppercase tracking-widest text-cielo-terracotta">
                        {{ $post->tag ?? 'Insight' }}
                    </span>
                    <span class="text-xs text-cielo-navy/50 font-inter uppercase tracking-widest">
                        {{ $post->published_at->format('M d, Y') }}
                    </span>
                </div>

                <h1 class="font-serif text-4xl md:text-6xl text-cielo-dark leading-tight mb-8">
                    {{ $post->title }}
                </h1>
            </div>

            {{-- 3. FOTO GRANDE (Abaixo do Título) --}}
            <div class="w-full aspect-[16/9] md:aspect-[21/9] overflow-hidden mb-16 shadow-sm">
                <img src="{{ Storage::url($post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
            </div>

            {{-- 4. CONTEÚDO --}}
            <article class="prose prose-lg prose-headings:font-serif prose-headings:font-normal prose-p:font-inter prose-p:font-light prose-p:text-cielo-navy/80 max-w-none mb-20 first-letter:text-5xl first-letter:font-serif first-letter:float-left first-letter:mr-3 first-letter:mt-[-4px]">
                {!! nl2br(e($post->content)) !!}
            </article>

            {{-- 5. AUTOR --}}
            <div class="border-t border-b border-gray-100 py-10 mb-24">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                        <img src="{{ $post->author_photo ?? asset('images/footer.jpg') }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">{{ __('blog.written_by') }}</p>
                        <h4 class="font-serif text-xl text-cielo-dark">{{ $post->author_name ?? 'Cielo Team' }}</h4>
                        <p class="text-sm font-light text-cielo-navy/60 mt-1">Specialist in Real Estate & Tropical Living</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- 6. VEJA TAMBÉM (Outros Artigos) --}}
        @if($relatedPosts->count() > 0)
            <div class="max-w-[90rem] mx-auto border-t border-gray-100 pt-24">
                <h3 class="font-serif text-3xl text-cielo-dark mb-12 text-center">{{ __('blog.related_title') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($relatedPosts as $related)
                        <div class="group cursor-pointer" onclick="window.location='{{ route('blog.show', $related) }}'">
                            <div class="aspect-[3/2] overflow-hidden mb-6 bg-gray-50">
                                <img src="{{ Storage::url($related->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            </div>
                            <h4 class="font-serif text-xl text-cielo-dark group-hover:text-cielo-terracotta transition-colors mb-2">
                                {{ $related->title }}
                            </h4>
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                                {{ $related->published_at->format('M d, Y') }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </main>

    <x-cielo.footer-big />

</x-cielo-layout>