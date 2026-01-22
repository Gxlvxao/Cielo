<x-cielo-layout>

    {{-- 1. HERO HEADER (Conceitual) --}}
    <div class="relative w-full h-[60vh] min-h-[500px] bg-cielo-dark">
        {{-- Use uma imagem de arquitetura/lifestyle aqui --}}
        <img src="{{ asset('images/about-team.jpg') }}" alt="Journal" class="absolute inset-0 w-full h-full object-cover opacity-60 grayscale mix-blend-multiply">
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/40"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <h1 class="font-serif text-4xl md:text-6xl text-white mb-6 max-w-4xl leading-tight">
                {{ __('blog.header.title') }}
            </h1>
            <p class="font-inter font-light text-lg md:text-xl text-white/90 max-w-2xl">
                {{ __('blog.header.subtitle') }}
            </p>
        </div>
    </div>

    {{-- 2. SEARCH BAR (Flutuante) --}}
    <div class="relative z-20 -mt-8 px-6 mb-24">
        <div class="max-w-2xl mx-auto bg-white shadow-xl p-2">
            <form action="{{ route('blog.index') }}" method="GET" class="relative flex items-center">
                <input type="text" name="search" 
                       value="{{ request('search') }}"
                       placeholder="{{ __('blog.search_placeholder') }}"
                       class="w-full border-none h-14 pl-6 pr-14 text-cielo-dark font-serif placeholder-gray-400 focus:ring-0">
                <button type="submit" class="absolute right-2 top-2 h-10 w-10 bg-cielo-dark text-white flex items-center justify-center hover:bg-cielo-terracotta transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <section class="pb-32 px-6">
        <div class="max-w-[90rem] mx-auto">

            {{-- 3. DESTAQUE (Uma dobra exclusiva) --}}
            @if(isset($featuredPost) && $featuredPost)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center mb-32 border-b border-gray-100 pb-20">
                    
                    {{-- Texto (Esquerda) --}}
                    <div class="order-2 lg:order-1 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="px-3 py-1 border border-cielo-dark/20 text-[10px] font-bold uppercase tracking-widest text-cielo-dark">
                                {{ $featuredPost->tag ?? 'Design' }}
                            </span>
                            <span class="text-xs text-cielo-navy/50 font-inter uppercase tracking-widest">
                                {{ $featuredPost->published_at->format('M d, Y') }}
                            </span>
                        </div>

                        <h2 class="font-serif text-4xl md:text-6xl text-cielo-dark leading-tight mb-8 hover:text-cielo-terracotta transition-colors">
                            <a href="{{ route('blog.show', $featuredPost) }}">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>

                        <p class="font-inter font-light text-lg text-cielo-navy/70 leading-relaxed mb-8 line-clamp-3">
                            {{ $featuredPost->excerpt }}
                        </p>

                        <div class="flex items-center gap-4 mt-4">
                            {{-- Autor --}}
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                    <img src="{{ $featuredPost->author_photo ?? asset('images/footer.jpg') }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-xs font-bold uppercase tracking-widest text-cielo-dark">
                                    {{ $featuredPost->author_name ?? 'Cielo Team' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Foto (Direita) --}}
                    <div class="order-1 lg:order-2 h-full min-h-[400px] relative overflow-hidden group cursor-pointer" onclick="window.location='{{ route('blog.show', $featuredPost) }}'">
                        <img src="{{ Storage::url($featuredPost->image) }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-105" 
                             alt="{{ $featuredPost->title }}">
                    </div>
                </div>
            @endif

            {{-- 4. GRID DE ARTIGOS MENORES --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-20">
                @foreach($posts as $post)
                    <div class="group cursor-pointer flex flex-col h-full" onclick="window.location='{{ route('blog.show', $post) }}'">
                        
                        {{-- Imagem --}}
                        <div class="relative overflow-hidden w-full aspect-[3/2] bg-gray-100 mb-8">
                            <img src="{{ Storage::url($post->image) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 alt="{{ $post->title }}">
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-cielo-dark">
                                {{ $post->tag ?? 'Journal' }}
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex flex-col flex-grow">
                            <span class="text-[10px] text-cielo-navy/40 font-bold uppercase tracking-widest mb-3">
                                {{ $post->published_at->format('M d, Y') }}
                            </span>
                            
                            <h3 class="font-serif text-2xl text-cielo-dark mb-4 group-hover:text-cielo-terracotta transition-colors leading-tight">
                                {{ $post->title }}
                            </h3>
                            
                            <p class="font-inter font-light text-sm text-cielo-navy/60 leading-relaxed line-clamp-3">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-20">
                {{ $posts->links() }}
            </div>

        </div>
    </section>

    <x-cielo.footer-big />

</x-cielo-layout>