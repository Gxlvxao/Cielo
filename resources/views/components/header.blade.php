<header class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
    <nav x-data="{ mobileOpen: false }" class="pointer-events-auto bg-gray-900/40 backdrop-blur-md border border-white/10 rounded-full px-6 py-3 shadow-2xl flex items-center justify-between gap-8 transition-all duration-300 hover:bg-gray-900/60 max-w-6xl w-full">
        
        <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2 group">
            <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform">
                C
            </div>
            <span class="font-heading font-bold text-lg tracking-wider text-white">
                CROW<span class="text-accent">GLOBAL</span>
            </span>
        </a>

        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('properties.index') }}" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all">
                {{ __('Explore Properties') }}
            </a>
            <a href="{{ route('home') }}#about" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all">
                {{ __('About Us') }}
            </a>
            <a href="{{ route('home') }}#services" class="text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 px-4 py-2 rounded-full transition-all">
                {{ __('Services') }}
            </a>
        </div>

        <div class="hidden md:flex items-center gap-4">
            <div class="flex items-center bg-black/20 rounded-full px-1 py-1 border border-white/5">
                <a href="{{ route('language.switch', 'pt') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'pt' ? 'bg-accent text-white shadow-sm' : 'text-gray-400 hover:text-white' }}">
                    PT
                </a>
                <a href="{{ route('language.switch', 'en') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'en' ? 'bg-accent text-white shadow-sm' : 'text-gray-400 hover:text-white' }}">
                    EN
                </a>
            </div>

            <div class="w-px h-6 bg-white/20 mx-1"></div>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-white bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-2 rounded-full transition-all">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-200 hover:text-white px-3 py-2 transition-colors">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('home') }}#contact" class="text-sm font-bold text-graphite bg-accent hover:bg-white hover:text-accent px-5 py-2 rounded-full transition-all shadow-lg shadow-accent/20">
                        {{ __('Request Access') }}
                    </a>
                @endauth
            @endif
        </div>

        <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-200 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>

        <div x-show="mobileOpen" 
             @click.away="mobileOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
             class="absolute top-full left-0 right-0 mt-4 bg-gray-900/95 backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-xl md:hidden flex flex-col gap-2" 
             style="display: none;">
            
            <a href="{{ route('properties.index') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('Explore Properties') }}
            </a>
            <a href="{{ route('home') }}#about" @click="mobileOpen = false" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('About Us') }}
            </a>
            <a href="{{ route('home') }}#services" @click="mobileOpen = false" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-colors">
                {{ __('Services') }}
            </a>

            <div class="flex justify-center gap-4 py-3 border-y border-white/10 my-1">
                <a href="{{ route('language.switch', 'pt') }}" class="text-sm font-bold {{ app()->getLocale() == 'pt' ? 'text-accent' : 'text-gray-400' }}">Português</a>
                <span class="text-gray-600">|</span>
                <a href="{{ route('language.switch', 'en') }}" class="text-sm font-bold {{ app()->getLocale() == 'en' ? 'text-accent' : 'text-gray-400' }}">English</a>
            </div>
            
            @auth
                <a href="{{ url('/dashboard') }}" class="block text-accent font-bold px-4 py-3 rounded-xl bg-white/5 text-center">
                    {{ __('Dashboard') }}
                </a>
            @else
                <div class="grid grid-cols-2 gap-3 mt-2 pt-2">
                    <a href="{{ route('login') }}" class="text-center text-gray-300 py-3 rounded-xl hover:bg-white/5 border border-white/10">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('home') }}#contact" @click="mobileOpen = false" class="text-center bg-accent text-white font-bold py-3 rounded-xl shadow-lg">
                        {{ __('Request Access') }}
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>