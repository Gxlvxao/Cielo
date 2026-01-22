@props(['posts'])

@php
    // Verifica se existem posts REAIS vindos do Controller
    $hasPosts = $posts->isNotEmpty();
    
    if ($hasPosts) {
        $featured = $posts->first(); 
        $others = $posts->skip(1);
    }
@endphp

<section class="bg-white py-32 px-6 relative z-20 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        {{-- Header --}}
        <div class="flex justify-between items-end mb-20 border-b border-cielo-dark/10 pb-8">
            <h2 class="font-serif text-5xl md:text-6xl text-cielo-dark">
                {{ __('Jornal Cielo') }}
            </h2>
            <a href="#" class="hidden md:inline-block text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-[#C9A35E] transition-colors">
                {{ __('Ver todos os artigos') }} →
            </a>
        </div>

        @if($hasPosts)
            {{-- === CONTEÚDO REAL DO BANCO DE DADOS === --}}
            
            {{-- 1. Post Destaque --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24 group cursor-pointer" 
                 onclick="window.location='{{ route('admin.posts.edit', $featured->id) }}'"> {{-- Link temporário para edit --}}
                
                <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col justify-center pr-8">
                    <div class="flex items-center gap-4 mb-6 text-xs font-bold uppercase tracking-widest">
                        <span class="text-[#C9A35E]">
                            {{ str_replace('_', ' ', $featured->category) }}
                        </span>
                        <span class="w-1 h-1 bg-cielo-dark/30 rounded-full"></span>
                        <span class="text-cielo-navy/60">
                            {{ $featured->published_at ? $featured->published_at->format('d M, Y') : 'Rascunho' }}
                        </span>
                    </div>

                    <h3 class="font-serif text-4xl md:text-5xl text-cielo-dark italic leading-[1.1] mb-6 group-hover:text-[#C9A35E] transition-colors duration-300">
                        {{ $featured->title }}
                    </h3>

                    <p class="font-sans text-lg text-cielo-navy/70 leading-relaxed mb-8 line-clamp-3">
                        {{ $featured->summary }}
                    </p>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 border border-gray-100">
                            {{-- Foto do Autor ou Placeholder --}}
                            <img src="{{ asset('images/about-team.jpg') }}" alt="Author" class="w-full h-full object-cover">
                        </div>
                        <div class="text-sm">
                            <p class="font-bold text-cielo-dark">{{ $featured->user->name ?? 'Equipe Cielo' }}</p>
                            <p class="text-xs text-cielo-navy/50 uppercase tracking-widest">Editor</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 order-1 lg:order-2 relative overflow-hidden aspect-[16/10]">
                    @if($featured->image_path)
                        <img src="{{ asset('storage/' . $featured->image_path) }}" 
                             alt="{{ $featured->title }}" 
                             class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                            [Sem Imagem de Capa]
                        </div>
                    @endif
                </div>
            </div>

            {{-- 2. Outros Posts (Se houver) --}}
            @if($others->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-cielo-dark/10 pt-16">
                    @foreach($others as $post)
                        <a href="#" class="group block">
                            <div class="overflow-hidden aspect-[4/3] mb-6 bg-gray-100 relative">
                                @if($post->image_path)
                                    <img src="{{ asset('storage/' . $post->image_path) }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                         alt="{{ $post->title }}">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">Sem Imagem</div>
                                @endif
                            </div>

                            <div class="flex flex-col h-full justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#C9A35E] mb-3 block">
                                        {{ str_replace('_', ' ', $post->category) }}
                                    </span>
                                    <h4 class="font-serif text-2xl text-cielo-dark mb-4 leading-tight group-hover:text-[#C9A35E] transition-colors line-clamp-2">
                                        {{ $post->title }}
                                    </h4>
                                </div>
                                <div class="mt-2 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-cielo-navy/50 font-medium">
                                    <span>{{ $post->published_at ? $post->published_at->format('d M') : 'Rascunho' }}</span>
                                    <span class="group-hover:translate-x-2 transition-transform duration-300 text-cielo-dark">Ler →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        @else
            {{-- === ESTADO VAZIO (SEM PLACEHOLDERS FALSOS) === --}}
            <div class="py-20 text-center border-t border-cielo-dark/5">
                <p class="font-serif text-2xl text-cielo-navy/40 italic">
                    "O silêncio precede a criação."
                </p>
                <p class="text-sm text-gray-400 mt-2 uppercase tracking-widest">
                    Nenhum artigo publicado ainda.
                </p>
                {{-- Botão visível apenas para Admin para facilitar --}}
                @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.posts.create') }}" class="inline-block mt-6 px-6 py-2 bg-[#C9A35E] text-white text-xs uppercase font-bold rounded hover:bg-[#B08D4B] transition">
                        Escrever Primeiro Artigo
                    </a>
                @endif
            </div>
        @endif

        <div class="mt-16 text-center md:hidden">
            <a href="#" class="inline-block border border-cielo-dark px-8 py-3 text-xs font-bold uppercase tracking-widest">
                {{ __('Ver todos') }}
            </a>
        </div>

    </div>
</section>