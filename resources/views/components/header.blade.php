<header class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
    {{-- MENU PRINCIPAL --}}
    <nav x-data="{ mobileOpen: false, toolsOpen: false }" class="pointer-events-auto bg-gray-900/40 backdrop-blur-md border border-white/10 rounded-full px-4 lg:px-6 py-3 shadow-2xl flex items-center justify-between gap-4 lg:gap-8 transition-all duration-300 hover:bg-gray-900/60 w-full max-w-[1400px]">
        
        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2 group relative z-50">
            <img src="{{ asset('images/extenso.png') }}" 
                 alt="Cielo Logo" 
                 class="h-10 md:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105 filter drop-shadow-md">
        </a>

        {{-- MENU DESKTOP --}}
        <div class="hidden lg:flex items-center gap-2 shrink-1">
            <a href="{{ route('properties.index') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all whitespace-nowrap {{ request()->routeIs('properties.*') ? 'bg-white/10 text-white' : '' }}">
                {{ __('nav.properties') }}
            </a>
            
            <a href="{{ route('pages.about') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all whitespace-nowrap {{ request()->routeIs('pages.about') ? 'bg-white/10 text-white' : '' }}">
                {{ __('nav.concept') }}
            </a>

            {{-- DROPDOWN FERRAMENTAS (DESKTOP) --}}
            <div class="relative" @click.away="toolsOpen = false">
                <button @click="toolsOpen = !toolsOpen" class="flex items-center gap-1 text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all whitespace-nowrap {{ request()->routeIs('tools.*') ? 'bg-white/10 text-white' : '' }}">
                    <span>{{ __('nav.tools') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="toolsOpen" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute top-full left-0 mt-2 w-56 bg-gray-900 border border-white/10 rounded-xl shadow-xl overflow-hidden py-1 z-50"
                     style="display: none;">
                    
                    <a href="{{ route('tools.gains') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        {{ __('nav.tools_gains') }}
                    </a>
                    <a href="{{ route('tools.imt') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        {{ __('nav.tools_imt') }}
                    </a>
                    <a href="{{ route('tools.credit') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        {{ __('nav.tools_credit') }}
                    </a>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all whitespace-nowrap {{ request()->routeIs('blog.*') ? 'bg-white/10 text-white' : '' }}">
                {{ __('nav.journal') }}
            </a>
        </div>

        {{-- ACTIONS --}}
        <div class="hidden lg:flex items-center gap-4 shrink-0">
            {{-- IDIOMA --}}
            <div class="flex items-center bg-black/20 rounded-full px-1 py-1 border border-white/5 shrink-0">
                <a href="{{ route('language.switch', 'pt') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'pt' ? 'bg-cielo-terracotta text-white shadow-sm' : 'text-gray-400 hover:text-white' }}">PT</a>
                <a href="{{ route('language.switch', 'en') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'en' ? 'bg-cielo-terracotta text-white shadow-sm' : 'text-gray-400 hover:text-white' }}">EN</a>
                <a href="{{ route('language.switch', 'fr') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'fr' ? 'bg-cielo-terracotta text-white shadow-sm' : 'text-gray-400 hover:text-white' }}">FR</a>
            </div>

            <div class="w-px h-6 bg-white/20"></div>

            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-white bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-2 rounded-full transition-all whitespace-nowrap">
                    {{ __('nav.dashboard') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-200 hover:text-white px-2 transition-colors whitespace-nowrap">
                    {{ __('nav.login') }}
                </a>
                <a href="{{ route('pages.contact') }}" class="text-sm font-bold text-gray-900 bg-cielo-terracotta hover:bg-white hover:text-cielo-terracotta px-5 py-2 rounded-full transition-all shadow-lg whitespace-nowrap">
                    {{ __('nav.request_access') }}
                </a>
            @endauth
        </div>

        {{-- MOBILE TOGGLE --}}
        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-200 hover:text-white focus:outline-none shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>

        {{-- === MOBILE SIDEBAR / MENU === --}}
        <div x-show="mobileOpen" 
             @click.away="mobileOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
             class="absolute top-full left-0 right-0 mt-4 bg-gray-900/95 backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-xl lg:hidden flex flex-col gap-2 max-h-[80vh] overflow-y-auto z-50" 
             style="display: none;">
            
            <a href="{{ route('home') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('nav.home') }}
            </a>
            <a href="{{ route('properties.index') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('nav.properties') }}
            </a>
            <a href="{{ route('pages.about') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('nav.concept') }}
            </a>
            
            {{-- FERRAMENTAS MOBILE --}}
            <div x-data="{ toolsMobileOpen: false }">
                <button @click="toolsMobileOpen = !toolsMobileOpen" class="w-full flex justify-between items-center text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                    <span>{{ __('nav.tools') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="toolsMobileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="toolsMobileOpen" class="pl-4 border-l border-white/10 ml-4 mt-1 space-y-1 bg-white/5 rounded-lg">
                    <a href="{{ route('tools.gains') }}" class="block text-gray-400 hover:text-white px-4 py-2 rounded-lg text-sm">{{ __('nav.tools_gains') }}</a>
                    <a href="{{ route('tools.imt') }}" class="block text-gray-400 hover:text-white px-4 py-2 rounded-lg text-sm">{{ __('nav.tools_imt') }}</a>
                    <a href="{{ route('tools.credit') }}" class="block text-gray-400 hover:text-white px-4 py-2 rounded-lg text-sm">{{ __('nav.tools_credit') }}</a>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('nav.journal') }}
            </a>

            <div class="flex justify-center gap-4 py-3 border-y border-white/10 my-1">
                <a href="{{ route('language.switch', 'pt') }}" class="text-sm font-bold {{ app()->getLocale() == 'pt' ? 'text-cielo-terracotta' : 'text-gray-400' }}">PT</a>
                <span class="text-gray-600">|</span>
                <a href="{{ route('language.switch', 'en') }}" class="text-sm font-bold {{ app()->getLocale() == 'en' ? 'text-cielo-terracotta' : 'text-gray-400' }}">EN</a>
                <span class="text-gray-600">|</span>
                <a href="{{ route('language.switch', 'fr') }}" class="text-sm font-bold {{ app()->getLocale() == 'fr' ? 'text-cielo-terracotta' : 'text-gray-400' }}">FR</a>
            </div>
            
            @auth
                <a href="{{ url('/dashboard') }}" class="block text-cielo-terracotta font-bold px-4 py-3 rounded-xl bg-white/5 text-center">
                    {{ __('nav.dashboard') }}
                </a>
            @else
                <div class="grid grid-cols-2 gap-3 mt-2 pt-2">
                    <a href="{{ route('login') }}" class="text-center text-gray-300 py-3 rounded-xl hover:bg-white/5 border border-white/10">
                        {{ __('nav.login') }}
                    </a>
                    <a href="{{ route('pages.contact') }}" class="text-center bg-cielo-terracotta text-white font-bold py-3 rounded-xl shadow-lg">
                        {{ __('nav.request_access') }}
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>