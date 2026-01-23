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
                
                {{-- REDES SOCIAIS LINKADAS E COM ÍCONES SVG --}}
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-cielo-dark">Share:</span>
                    
                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post)) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       title="Compartilhar no LinkedIn"
                       class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-cielo-dark hover:text-white hover:border-cielo-dark transition-all duration-300 group">
                        <svg class="w-3 h-3 fill-current text-cielo-navy/60 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/>
                        </svg>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . route('blog.show', $post)) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       title="Compartilhar no WhatsApp"
                       class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-cielo-dark hover:text-white hover:border-cielo-dark transition-all duration-300 group">
                        <svg class="w-3 h-3 fill-current text-cielo-navy/60 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                        </svg>
                    </a>
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