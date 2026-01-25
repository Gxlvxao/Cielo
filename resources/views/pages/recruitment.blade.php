<x-site-layout>
    {{-- Header Spacing --}}
    <div class="h-24 bg-cielo-dark"></div>
    
    <div class="relative min-h-screen flex flex-col lg:flex-row">
        
        {{-- Lado Esquerdo: Imagem Hero (Sticky no Desktop) --}}
        <div class="w-full lg:w-1/2 h-[50vh] lg:h-screen lg:sticky lg:top-0 overflow-hidden relative group">
            <img src="/images/about-team.jpg" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] ease-out group-hover:scale-105" 
                 alt="Cielo Team">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent lg:bg-black/20"></div>
            
            <div class="absolute bottom-8 left-8 lg:bottom-16 lg:left-16 text-white z-10 max-w-lg">
                <span class="inline-block py-1 px-3 border border-white/30 rounded-full text-xs tracking-[0.2em] uppercase mb-4 backdrop-blur-sm">Carreiras</span>
                <h1 class="font-serif text-4xl lg:text-6xl mb-4 leading-tight shadow-sm">{{ __('recruitment.hero_title') }}</h1>
                <p class="text-base lg:text-xl font-light opacity-90 border-l-2 border-cielo-terracotta pl-4">{{ __('recruitment.hero_subtitle') }}</p>
            </div>
        </div>

        {{-- Lado Direito: Conteúdo (Scrollable) --}}
        <div class="w-full lg:w-1/2 bg-white px-6 py-16 lg:p-24 flex items-center">
            <div class="max-w-lg mx-auto w-full space-y-16">
                
                {{-- Intro --}}
                <div class="space-y-6">
                    <h2 class="text-3xl lg:text-4xl font-serif text-cielo-dark">
                        {{ __('recruitment.intro_title') }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-lg font-light">
                        {{ __('recruitment.intro_text') }}
                    </p>
                </div>

                {{-- Lista de Vagas --}}
                <div class="space-y-8">
                    <div class="flex items-end justify-between border-b border-gray-200 pb-4">
                        <h3 class="font-bold text-xs uppercase tracking-[0.15em] text-gray-400">
                            {{ __('recruitment.openings_title') }}
                        </h3>
                        <span class="text-xs text-cielo-terracotta font-serif italic">Junte-se à elite</span>
                    </div>
                    
                    <ul class="space-y-4">
                        {{-- Vaga 1 --}}
                        <li class="group">
                            <a href="#" class="block p-6 rounded-none border-l-2 border-transparent hover:border-cielo-terracotta bg-gray-50 hover:bg-white hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-serif text-xl text-gray-900 group-hover:text-cielo-terracotta transition-colors mb-1">
                                            {{ __('recruitment.role_consultant') }}
                                        </h4>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ __('recruitment.location_lisbon') }}
                                        </div>
                                    </div>
                                    <span class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-cielo-terracotta group-hover:text-cielo-terracotta transition-all">
                                        →
                                    </span>
                                </div>
                            </a>
                        </li>

                        {{-- Vaga 2 --}}
                        <li class="group">
                            <a href="#" class="block p-6 rounded-none border-l-2 border-transparent hover:border-cielo-terracotta bg-gray-50 hover:bg-white hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-serif text-xl text-gray-900 group-hover:text-cielo-terracotta transition-colors mb-1">
                                            {{ __('recruitment.role_broker') }}
                                        </h4>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ __('recruitment.location_porto') }}
                                        </div>
                                    </div>
                                    <span class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-cielo-terracotta group-hover:text-cielo-terracotta transition-all">
                                        →
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Box de Candidatura Espontânea (Dark Mode para Contraste) --}}
                <div class="bg-cielo-dark text-white p-8 lg:p-10 relative overflow-hidden group">
                    {{-- Elemento Decorativo --}}
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-cielo-terracotta/20 rounded-full blur-2xl group-hover:bg-cielo-terracotta/30 transition-colors"></div>

                    <h3 class="font-serif text-2xl mb-4 relative z-10">{{ __('recruitment.spontaneous_title') }}</h3>
                    <p class="text-white/70 mb-8 font-light leading-relaxed relative z-10 max-w-sm">
                        {{ __('recruitment.spontaneous_text') }}
                    </p>
                    
                    <a href="mailto:info@cielo.pt" class="inline-flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-white border-b border-cielo-terracotta pb-2 hover:text-cielo-terracotta transition-colors relative z-10">
                        Enviar Candidatura
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>
    
    <x-cielo.footer-big />
</x-site-layout>