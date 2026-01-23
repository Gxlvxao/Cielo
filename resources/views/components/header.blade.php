<header class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4 sm:px-6 pointer-events-none">
    
    {{-- NAV CONTAINER PRINCIPAL --}}
    <nav x-data="{ mobileOpen: false, toolsOpen: false }" 
         @click.away="mobileOpen = false; toolsOpen = false"
         class="pointer-events-auto w-full max-w-7xl bg-gray-900/80 backdrop-blur-xl border border-white/10 rounded-full pl-6 pr-3 py-3 shadow-2xl flex items-center justify-between transition-all duration-300 hover:bg-gray-900/90 ring-1 ring-white/5">
        
        {{-- ESQUERDA: LOGO --}}
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2 group relative z-50 focus:outline-none">
                <img src="{{ asset('images/extenso.png') }}" 
                     alt="{{ config('app.name') }}" 
                     class="h-9 md:h-10 w-auto object-contain transition-transform duration-500 group-hover:scale-105 group-hover:brightness-110">
            </a>

            {{-- DESKTOP MENU LINKS --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('properties.index') }}" 
                   class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->routeIs('properties.*') ? 'text-white bg-white/10 shadow-inner' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    {{ __('nav.properties') }}
                </a>
                
                <a href="{{ route('pages.about') }}" 
                   class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->routeIs('pages.about') ? 'text-white bg-white/10 shadow-inner' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    {{ __('nav.concept') }}
                </a>

                {{-- DROPDOWN FERRAMENTAS --}}
                <div class="relative">
                    <button @click="toolsOpen = !toolsOpen" 
                            class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->routeIs('tools.*') ? 'text-white bg-white/10 shadow-inner' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                        <span>{{ __('nav.tools') }}</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-300" :class="toolsOpen ? 'rotate-180 text-cielo-terracotta' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    {{-- Dropdown Content --}}
                    <div x-show="toolsOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute top-full left-0 mt-3 w-56 bg-gray-900/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl overflow-hidden py-2 z-50 ring-1 ring-black/20"
                         style="display: none;">
                        
                        <a href="{{ route('tools.gains') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-cielo-terracotta transition-colors group">
                            <span class="w-1 h-1 rounded-full bg-gray-600 group-hover:bg-cielo-terracotta transition-colors"></span>
                            {{ __('nav.tools_gains') }}
                        </a>
                        <a href="{{ route('tools.imt') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-cielo-terracotta transition-colors group">
                            <span class="w-1 h-1 rounded-full bg-gray-600 group-hover:bg-cielo-terracotta transition-colors"></span>
                            {{ __('nav.tools_imt') }}
                        </a>
                        <a href="{{ route('tools.credit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-cielo-terracotta transition-colors group">
                            <span class="w-1 h-1 rounded-full bg-gray-600 group-hover:bg-cielo-terracotta transition-colors"></span>
                            {{ __('nav.tools_credit') }}
                        </a>
                    </div>
                </div>

                <a href="{{ route('blog.index') }}" 
                   class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->routeIs('blog.*') ? 'text-white bg-white/10 shadow-inner' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    {{ __('nav.journal') }}
                </a>
            </div>
        </div>

        {{-- DIREITA: ACTIONS & MOBILE TOGGLE --}}
        <div class="flex items-center gap-2 sm:gap-4">
            
            {{-- IDIOMA (Desktop) --}}
            <div class="hidden lg:flex items-center bg-black/20 rounded-full p-1 border border-white/5">
                @foreach(['pt', 'en', 'fr'] as $lang)
                    <a href="{{ route('language.switch', $lang) }}" 
                       class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider transition-all duration-300 {{ app()->getLocale() == $lang ? 'bg-cielo-terracotta text-white shadow-md' : 'text-gray-400 hover:text-white' }}">
                       {{ $lang }}
                    </a>
                @endforeach
            </div>

            <div class="hidden lg:block w-px h-6 bg-white/10"></div>

            {{-- CTA / LOGIN --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-gray-900 bg-white hover:bg-cielo-terracotta hover:text-white px-5 py-2.5 rounded-full transition-all duration-300 shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:shadow-cielo-terracotta/30">
                        {{ __('nav.dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white px-2 transition-colors">
                        {{ __('nav.login') }}
                    </a>
                    <a href="{{ route('pages.contact') }}" class="text-sm font-bold text-white bg-cielo-terracotta hover:bg-white hover:text-cielo-terracotta px-5 py-2.5 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        {{ __('nav.request_access') }}
                    </a>
                @endauth
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <button @click="mobileOpen = !mobileOpen" 
                    class="lg:hidden p-2 text-gray-300 hover:text-white bg-white/5 hover:bg-white/10 rounded-full transition-all focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- === MOBILE DROPDOWN MENU === --}}
        <div x-show="mobileOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             class="absolute top-full left-0 right-0 mt-3 p-4 bg-gray-900/95 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl lg:hidden flex flex-col gap-2 ring-1 ring-white/10 overflow-hidden">
            
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                    {{ __('nav.home') }}
                </a>
                <a href="{{ route('properties.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                    {{ __('nav.properties') }}
                </a>
                <a href="{{ route('pages.about') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                    {{ __('nav.concept') }}
                </a>
                
                {{-- Ferramentas Mobile --}}
                <div x-data="{ toolsMobile: false }" class="rounded-xl overflow-hidden bg-white/5">
                    <button @click="toolsMobile = !toolsMobile" class="w-full flex items-center justify-between px-4 py-3 text-base font-medium text-gray-300 hover:text-white transition-colors">
                        <span>{{ __('nav.tools') }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300" :class="toolsMobile ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="toolsMobile" x-collapse class="bg-black/20 border-t border-white/5">
                        <a href="{{ route('tools.gains') }}" class="block pl-8 pr-4 py-3 text-sm text-gray-400 hover:text-cielo-terracotta">{{ __('nav.tools_gains') }}</a>
                        <a href="{{ route('tools.imt') }}" class="block pl-8 pr-4 py-3 text-sm text-gray-400 hover:text-cielo-terracotta">{{ __('nav.tools_imt') }}</a>
                        <a href="{{ route('tools.credit') }}" class="block pl-8 pr-4 py-3 text-sm text-gray-400 hover:text-cielo-terracotta">{{ __('nav.tools_credit') }}</a>
                    </div>
                </div>

                <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                    {{ __('nav.journal') }}
                </a>
            </div>

            <div class="h-px bg-white/10 my-2"></div>

            {{-- Idioma Mobile --}}
            <div class="flex justify-center gap-2 py-2">
                @foreach(['pt', 'en', 'fr'] as $lang)
                    <a href="{{ route('language.switch', $lang) }}" 
                       class="w-10 h-10 flex items-center justify-center rounded-full text-xs font-bold transition-all {{ app()->getLocale() == $lang ? 'bg-cielo-terracotta text-white' : 'bg-white/5 text-gray-400' }}">
                        {{ strtoupper($lang) }}
                    </a>
                @endforeach
            </div>

            <div class="h-px bg-white/10 my-2"></div>

            {{-- Auth Mobile --}}
            @auth
                <a href="{{ url('/dashboard') }}" class="block w-full py-3 text-center rounded-xl bg-cielo-terracotta text-white font-bold shadow-lg">
                    {{ __('nav.dashboard') }}
                </a>
            @else
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('login') }}" class="py-3 text-center rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 font-medium">
                        {{ __('nav.login') }}
                    </a>
                    <a href="{{ route('pages.contact') }}" class="py-3 text-center rounded-xl bg-white text-gray-900 hover:bg-gray-100 font-bold">
                        {{ __('nav.request_access') }}
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>