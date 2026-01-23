<nav x-data="{ open: false }" class="bg-[#0B0F19] border-b border-white/10 sticky top-0 z-40 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cielo-terracotta to-orange-700 flex items-center justify-center text-white font-serif font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                            C
                        </div>
                        <span class="text-white font-serif text-xl tracking-wider group-hover:text-cielo-terracotta transition-colors">CIELO</span>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" 
                       class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                        {{ __('Dashboard') }}
                    </a>

                    @can('isAdmin')
                        <div class="h-4 w-px bg-white/10 mx-2"></div> {{-- Separador --}}

                        <a href="{{ route('admin.dashboard') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{ __('Overview') }}
                        </a>
                        <a href="{{ route('admin.access-requests') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('admin.access-requests') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{ __('Requests') }}
                        </a>
                        <a href="{{ route('admin.properties') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('admin.properties') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{-- Mudei aqui para evitar o erro do array --}}
                            Properties
                        </a>
                        <a href="{{ route('admin.posts.index') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('admin.posts.*') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{ __('Jornal') }}
                        </a>
                    @endcan

                    @can('manageProperties')
                        <div class="h-4 w-px bg-white/10 mx-2"></div>

                        <a href="{{ route('properties.my') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('properties.my') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{ __('My Properties') }}
                        </a>
                        <a href="{{ route('properties.create') }}" 
                           class="text-sm font-medium transition-colors duration-300 {{ request()->routeIs('properties.create') ? 'text-white' : 'text-gray-400 hover:text-cielo-terracotta' }}">
                            {{ __('Add Property') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                
                {{-- Atalho para o Site --}}
                <a href="{{ route('home') }}" class="text-xs font-medium text-gray-500 hover:text-cielo-terracotta transition-colors flex items-center gap-1">
                    <span>{{ __('Back to Site') }}</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150 group">
                            <div class="text-right hidden md:block">
                                <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase tracking-wider">{{ Auth::user()->role ?? 'User' }}</div>
                            </div>
                            
                            <div class="w-10 h-10 rounded-full bg-gray-800 border border-white/10 flex items-center justify-center text-cielo-terracotta font-bold group-hover:bg-white/10 group-hover:border-cielo-terracotta/50 transition-all">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>

                            <svg class="fill-current h-4 w-4 text-gray-500 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-400 border-b border-gray-100 dark:border-gray-700">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0B0F19] border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-cielo-terracotta hover:bg-white/5 hover:border-cielo-terracotta">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('isAdmin')
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Administration</div>
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-300">
                    {{ __('Overview') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.access-requests')" :active="request()->routeIs('admin.access-requests')" class="text-gray-300">
                    {{ __('Requests') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.properties')" :active="request()->routeIs('admin.properties')" class="text-gray-300">
                    Properties
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')" class="text-gray-300">
                    {{ __('Jornal') }}
                </x-responsive-nav-link>
            @endcan

            @can('manageProperties')
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Management</div>
                <x-responsive-nav-link :href="route('properties.my')" :active="request()->routeIs('properties.my')" class="text-gray-300">
                    {{ __('My Properties') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('properties.create')" :active="request()->routeIs('properties.create')" class="text-gray-300">
                    {{ __('Add Property') }}
                </x-responsive-nav-link>
            @endcan
            
            <div class="border-t border-white/10 my-2"></div>
            <x-responsive-nav-link :href="route('properties.index')" class="text-gray-400">
                {{ __('Explore Properties') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-white/10 bg-black/20">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-cielo-terracotta flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-400 hover:text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('home')" class="text-gray-400 hover:text-white">
                    {{ __('Back to Site') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-red-400 hover:text-red-300 hover:bg-red-500/10">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>