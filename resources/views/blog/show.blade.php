<x-cielo-layout>
    {{-- SEO & Meta Tags específicas podem ser injetadas aqui via @push('head') se tiver --}}

    {{-- 1. PROGRESS BAR DE LEITURA --}}
    <div class="fixed top-0 left-0 h-1 bg-cielo-terracotta z-50 transition-all duration-300" id="readingProgress" style="width: 0%"></div>

    <article class="relative pt-32 pb-20">
        
        {{-- 2. HEADER EDITORIAL --}}
        <header class="max-w-4xl mx-auto px-6 text-center mb-16">
            {{-- Breadcrumb / Categoria --}}
            <div class="flex items-center justify-center gap-4 mb-6">
                <a href="{{ route('blog.index') }}" class="text-xs font-bold uppercase tracking-widest text-cielo-navy/40 hover:text-cielo-terracotta transition-colors">
                    Journal
                </a>
                <span class="text-cielo-navy/20">•</span>
                <span class="px-3 py-1 border border-cielo-dark/20 text-[10px] font-bold uppercase tracking-widest text-cielo-dark">
                    {{ $post->category ?? 'Real Estate' }}
                </span>
            </div>

            <h1 class="font-serif text-4xl md:text-6xl text-cielo-dark mb-8 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-center gap-8 text-sm font-inter text-cielo-navy/60">
                <div class="flex items-center gap-2">
                    {{-- Proteção contra data nula --}}
                    <span>{{ $post->published_at?->format('M d, Y') ?? 'Rascunho' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-1 h-1 rounded-full bg-cielo-terracotta"></span>
                    <span>{{ ceil(str_word_count(strip_tags($post->content ?? '')) / 200) }} min de leitura</span>
                </div>
            </div>
        </header>

        {{-- 3. HERO IMAGE --}}
        <div class="w-full h-[50vh] md:h-[70vh] mb-20 overflow-hidden relative">
            @if($post->image_path)
                <img src="{{ Storage::url($post->image_path) }}" 
                     alt="{{ $post->title }}" 
                     class="absolute inset-0 w-full h-full object-cover"
                     data-aos="zoom-out" 
                     data-aos-duration="1500">
            @else
                <div class="absolute inset-0 bg-gray-100 flex items-center justify-center">
                    <span class="text-cielo-navy/20 font-serif text-4xl italic">Cielo.</span>
                </div>
            @endif
        </div>

        {{-- 4. CONTEÚDO (Prose) --}}
        <div class="max-w-3xl mx-auto px-6">
            {{-- Lead / Resumo --}}
            @if($post->summary)
                <p class="text-xl md:text-2xl font-serif text-cielo-dark/80 leading-relaxed mb-12 border-l-4 border-cielo-terracotta pl-6 italic">
                    {{ $post->summary }}
                </p>
            @endif

            {{-- Corpo do Texto --}}
            {{-- CORREÇÃO AQUI: Str::markdown($post->content ?? '') --}}
            <div class="prose prose-lg prose-stone max-w-none font-inter font-light text-cielo-navy/80 
                        prose-headings:font-serif prose-headings:text-cielo-dark 
                        prose-a:text-cielo-terracotta prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-none prose-img:shadow-lg">
                {!! Str::markdown($post->content ?? '') !!}
            </div>

            {{-- Tags & Share --}}
            <div class="mt-20 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex gap-2">
                     <span class="text-xs text-cielo-navy/50">#{{ $post->category ?? 'Cielo' }}</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-cielo-dark">Share:</span>
                    <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in text-xs"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-cielo-dark hover:text-white transition-colors">
                        <i class="fab fa-whatsapp text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </article>

    {{-- 5. ARTIGOS RELACIONADOS --}}
    @if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
        <section class="bg-gray-50 py-24 px-6">
            <div class="max-w-[90rem] mx-auto">
                <div class="flex items-end justify-between mb-12 border-b border-cielo-dark/10 pb-6">
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-widest text-cielo-terracotta mb-2">Continue Lendo</span>
                        <h2 class="font-serif text-3xl md:text-4xl text-cielo-dark">Curadoria Relacionada</h2>
                    </div>
                    <a href="{{ route('blog.index') }}" class="hidden md:inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta transition-colors">
                        Ver Todos <span class="text-lg">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($relatedPosts as $related)
                        <div class="group cursor-pointer flex flex-col" onclick="window.location='{{ route('blog.show', $related->slug) }}'">
                            <div class="relative overflow-hidden w-full aspect-[4/3] bg-white mb-6">
                                @if($related->image_path)
                                    <img src="{{ Storage::url($related->image_path) }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">Sem Imagem</div>
                                @endif
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                            </div>
                            
                            <span class="text-[10px] text-cielo-navy/40 font-bold uppercase tracking-widest mb-3">
                                {{ $related->published_at?->format('M d, Y') ?? '' }}
                            </span>
                            
                            <h3 class="font-serif text-xl text-cielo-dark mb-2 group-hover:text-cielo-terracotta transition-colors leading-tight">
                                {{ $related->title }}
                            </h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cielo.off-market-cta />
    <x-cielo.footer-big />

    <script>
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("readingProgress").style.width = scrolled + "%";
        };
    </script>
</x-cielo-layout>