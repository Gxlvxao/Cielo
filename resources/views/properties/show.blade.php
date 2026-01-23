<x-site-layout>

    <div class="pt-32 pb-20 px-4 md:px-6 bg-white min-h-screen">
        <div class="max-w-[90rem] mx-auto">

            {{-- 1. HEADER SIMPLES (Navegação) --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 px-2">
                <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-cielo-navy/40">
                    <a href="{{ route('home') }}" class="hover:text-cielo-terracotta transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('properties.index') }}" class="hover:text-cielo-terracotta transition-colors">{{ __('nav.curation') }}</a>
                    <span>/</span>
                    <span class="text-cielo-dark">{{ $property->city }}</span>
                </div>
                
                {{-- Título Principal --}}
                <h1 class="font-serif text-4xl md:text-5xl text-cielo-dark leading-tight max-w-4xl">
                    {{ $property->title }}
                </h1>
            </div>

            {{-- 2. GALERIA FLUTUANTE (Slider com Setas) --}}
            <div class="relative w-full aspect-[4/3] md:aspect-[21/9] bg-gray-100 rounded-[2rem] overflow-hidden shadow-2xl mb-16 group" 
                 x-data="{ 
                    activeSlide: 0,
                    slides: {{ $property->images ? count($property->images) : 0 }},
                    next() { this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1 },
                    prev() { this.activeSlide = (this.activeSlide === 0) ? this.slides - 1 : this.activeSlide - 1 }
                 }">
                
                {{-- Imagens --}}
                @if($property->images && count($property->images) > 0)
                    @foreach($property->images as $index => $image)
                        <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                             x-show="activeSlide === {{ $loop->index }}"
                             x-transition:enter="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="opacity-100"
                             x-transition:leave-end="opacity-0">
                            <img src="{{ Storage::url($image) }}" class="w-full h-full object-cover">
                            {{-- Gradiente sutil em baixo --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-50"></div>
                        </div>
                    @endforeach

                    {{-- Setas de Navegação --}}
                    <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-md hover:bg-white text-white hover:text-cielo-dark rounded-full flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    
                    <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-md hover:bg-white text-white hover:text-cielo-dark rounded-full flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>

                    {{-- Contador --}}
                    <div class="absolute bottom-6 right-6 bg-black/50 backdrop-blur-md px-4 py-1 rounded-full text-white text-xs font-bold tracking-widest">
                        <span x-text="activeSlide + 1"></span> / {{ count($property->images) }}
                    </div>
                @else
                    {{-- Fallback se não tiver imagens --}}
                    <div class="w-full h-full flex items-center justify-center text-cielo-navy/30">
                        <img src="{{ Storage::url($property->cover_image) }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
                
                {{-- COLUNA ESQUERDA (Conteúdo) --}}
                <div class="lg:col-span-8 space-y-16">
                    
                    {{-- Descrição Principal --}}
                    <div class="prose prose-lg max-w-none text-cielo-navy/70 font-light font-inter leading-relaxed">
                        <h3 class="font-serif text-2xl text-cielo-dark mb-6">{{ __('properties.show.about') }}</h3>
                        {!! nl2br(e($property->description)) !!}
                    </div>

                    {{-- SPECS EM QUADRINHOS (Abaixo da descrição) --}}
                    <div>
                        <h3 class="font-serif text-2xl text-cielo-dark mb-6">Detalhes</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            
                            {{-- Card Quartos --}}
                            @if($property->bedrooms)
                            <div class="bg-gray-50 p-6 rounded-2xl text-center border border-gray-100 hover:border-cielo-terracotta/30 transition-colors">
                                <span class="block font-serif text-3xl text-cielo-dark mb-1">{{ $property->bedrooms }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/40">{{ __('properties.show.bedrooms') }}</span>
                            </div>
                            @endif

                            {{-- Card Banheiros --}}
                            @if($property->bathrooms)
                            <div class="bg-gray-50 p-6 rounded-2xl text-center border border-gray-100 hover:border-cielo-terracotta/30 transition-colors">
                                <span class="block font-serif text-3xl text-cielo-dark mb-1">{{ $property->bathrooms }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/40">{{ __('properties.show.bathrooms') }}</span>
                            </div>
                            @endif

                            {{-- Card Área Útil --}}
                            @if($property->area)
                            <div class="bg-gray-50 p-6 rounded-2xl text-center border border-gray-100 hover:border-cielo-terracotta/30 transition-colors">
                                <span class="block font-serif text-3xl text-cielo-dark mb-1">{{ intval($property->area) }}<span class="text-base align-top text-cielo-navy/40 ml-0.5">m²</span></span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/40">{{ __('properties.show.area') }}</span>
                            </div>
                            @endif

                            {{-- Card Terreno (Se houver) --}}
                            @if($property->land_area)
                            <div class="bg-gray-50 p-6 rounded-2xl text-center border border-gray-100 hover:border-cielo-terracotta/30 transition-colors">
                                <span class="block font-serif text-3xl text-cielo-dark mb-1">{{ intval($property->land_area) }}<span class="text-base align-top text-cielo-navy/40 ml-0.5">m²</span></span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/40">{{ __('properties.show.land') }}</span>
                            </div>
                            @endif

                        </div>
                    </div>

                    {{-- Vídeo --}}
                    @if($property->video_embed)
                        <div>
                            <h3 class="font-serif text-2xl text-cielo-dark mb-6">{{ __('properties.show.video') }}</h3>
                            <div class="aspect-video w-full bg-black rounded-2xl overflow-hidden shadow-lg">
                                <iframe src="{{ $property->video_embed }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- COLUNA DIREITA (Sticky Sidebar / Card de Preço) --}}
                <div class="lg:col-span-4 relative" x-data="{ showModal: false }">
                    <div class="sticky top-32 bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/50">
                        
                        {{-- Preço --}}
                        <div class="text-center mb-8">
                            <p class="text-xs font-bold uppercase tracking-widest text-cielo-terracotta mb-2">{{ __('properties.show.investment') }}</p>
                            <p class="font-serif text-4xl text-cielo-dark">
                                {{ $property->price > 0 ? $property->formatted_price : __('properties.show.price_request') }}
                            </p>
                        </div>

                        {{-- Botões --}}
                        <div class="space-y-4">
                            <button @click="showModal = true" class="w-full bg-cielo-dark text-white h-14 rounded-xl flex items-center justify-center text-xs font-bold uppercase tracking-widest hover:bg-cielo-terracotta transition-colors duration-300 shadow-lg shadow-cielo-dark/10">
                                {{ __('properties.show.schedule') }}
                            </button>

                            @if($property->whatsapp_link)
                                <a href="{{ $property->whatsapp_link }}" target="_blank" class="w-full border border-cielo-dark text-cielo-dark h-14 rounded-xl flex items-center justify-center text-xs font-bold uppercase tracking-widest hover:bg-cielo-dark hover:text-white transition-colors duration-300">
                                    {{ __('properties.show.whatsapp') }}
                                </a>
                            @endif
                        </div>

                        <p class="text-[10px] text-center text-cielo-navy/40 mt-6 leading-relaxed">
                            {{ __('properties.show.disclaimer') }}
                        </p>
                    </div>

                    {{-- MODAL FORM --}}
                    <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center px-4" style="display: none;">
                        <div class="absolute inset-0 bg-cielo-dark/80 backdrop-blur-sm" @click="showModal = false"></div>
                        
                        <div class="relative bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-10"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            
                            <div class="flex justify-between items-center mb-8">
                                <h3 class="font-serif text-2xl text-cielo-dark">{{ __('properties.show.schedule') }}</h3>
                                <button @click="showModal = false" class="text-cielo-navy/40 hover:text-cielo-dark">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>

                            <form action="{{ route('properties.visit', $property) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="space-y-1">
                                    <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">{{ __('properties.form.name') }}</label>
                                    <input type="text" name="name" required class="w-full border-0 border-b border-gray-200 focus:border-cielo-dark focus:ring-0 px-0 py-2 bg-transparent transition-colors" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">{{ __('properties.form.email') }}</label>
                                    <input type="email" name="email" required class="w-full border-0 border-b border-gray-200 focus:border-cielo-dark focus:ring-0 px-0 py-2 bg-transparent transition-colors" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">{{ __('properties.form.phone') }}</label>
                                    <input type="text" name="phone" required class="w-full border-0 border-b border-gray-200 focus:border-cielo-dark focus:ring-0 px-0 py-2 bg-transparent transition-colors">
                                </div>
                                
                                <button type="submit" class="w-full bg-cielo-dark text-white h-12 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-cielo-terracotta transition-colors mt-4">
                                    {{ __('properties.form.submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 3. VEJA TAMBÉM (Recomendações) --}}
    @php
        $relatedProperties = \App\Models\Property::where('id', '!=', $property->id)
                            ->where('status', 'active')
                            ->where('is_exclusive', false)
                            ->inRandomOrder()
                            ->take(3)
                            ->get();
    @endphp

    @if($relatedProperties->count() > 0)
        <section class="bg-gray-50 py-32 px-6 border-t border-gray-200">
            <div class="max-w-[90rem] mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                    <div class="max-w-2xl">
                        <span class="font-inter text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-6 block">
                            {{ __('properties.show.related_label') }}
                        </span>
                        <h2 class="font-inter font-light text-4xl md:text-5xl text-cielo-dark leading-[1.1]">
                            {{ __('properties.show.related_title') }}
                        </h2>
                    </div>
                    <div class="hidden md:block pb-2">
                        <a href="{{ route('properties.index') }}" class="text-xs font-bold uppercase tracking-widest text-cielo-dark hover:text-cielo-terracotta border-b border-gray-300 pb-1 hover:border-cielo-terracotta transition-all">
                            {{ __('home.properties.view_all') }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
                    @foreach($relatedProperties as $related)
                        <div class="group cursor-pointer flex flex-col h-full" onclick="window.location='{{ route('properties.show', $related) }}'">
                            <div class="relative overflow-hidden w-full aspect-[2/3] bg-gray-100 mb-8 shadow-sm">
                                <img src="{{ Storage::url($related->cover_image) }}" class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" alt="{{ $related->title }}">
                                @if($related->is_exclusive)
                                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md text-cielo-dark px-3 py-2 text-[10px] font-bold uppercase tracking-widest z-10">Off-Market</div>
                                @endif
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
                            </div>
                            <div class="flex flex-col flex-grow px-1">
                                <h3 class="font-inter font-light text-2xl text-cielo-dark mb-2 group-hover:text-cielo-terracotta transition-colors truncate">{{ $related->title }}</h3>
                                <p class="font-inter font-light text-cielo-navy/60 text-sm leading-relaxed line-clamp-2 mb-6 h-10">{{ $related->description }}</p>
                                <div class="w-full h-px bg-gray-200 mb-5 group-hover:bg-cielo-terracotta/30 transition-colors"></div>
                                <div class="flex items-center justify-between text-cielo-dark">
                                    @if($related->bedrooms) <div class="flex items-center gap-2"><span class="font-inter text-lg font-light">{{ $related->bedrooms }}</span><span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Quartos</span></div> @endif
                                    @if($related->area) <div class="flex items-center gap-2 border-l border-gray-200 pl-4"><span class="font-inter text-lg font-light">{{ intval($related->area) }}<span class="text-xs align-top opacity-40 ml-[1px]">m²</span></span><span class="text-[9px] font-bold uppercase tracking-widest opacity-40">Área</span></div> @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cielo.footer-big />

</x-cielo-layout>