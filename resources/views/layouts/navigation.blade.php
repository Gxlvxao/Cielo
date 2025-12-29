<nav x-data="{ open: false }" class="bg-graphite border-b border-accent/50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white font-heading text-xl font-bold">
                        <span class="text-white">CROW</span>
                        <span class="text-accent"> GLOBAL</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-accent border-transparent hover:border-accent">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @can('isAdmin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-accent border-transparent hover:border-accent">
                            {{ __('Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.access-requests')" :active="request()->routeIs('admin.access-requests')" class="text-white hover:text-accent border-transparent hover:border-accent">
                            {{ __('Requests') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.properties')" :active="request()->routeIs('admin.properties')" class="text-white hover:text-accent border-transparent hover:border-accent">
                            {{ __('Properties (Admin)') }}
                        </x-nav-link>
                    @endcan

                    @can('manageProperties')
                        <x-nav-link :href="route('properties.my')" :active="request()->routeIs('properties.my')" class="text-white hover:text-accent border-transparent hover:border-accent">
                            {{ __('My Properties') }}
                        </x-nav-link>
                        <x-nav-link :href="route('properties.create')" :active="request()->routeIs('properties.create')" class="text-white hover:text-accent border-transparent hover:border-accent">
                            {{ __('Add Property') }}
                        </x-nav-link>
                    @endcan

                    <x-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.index')" class="text-white hover:text-accent border-transparent hover:border-accent">
                        {{ __('Explore Properties') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-graphite hover:text-accent focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('home')">
                            {{ __('Back to Site') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-accent/20 focus:outline-none focus:bg-accent/20 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-graphite/95">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-accent">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('isAdmin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-accent">
                    {{ __('Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.access-requests')" :active="request()->routeIs('admin.access-requests')" class="text-white hover:text-accent">
                    {{ __('Requests') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.properties')" :active="request()->routeIs('admin.properties')" class="text-white hover:text-accent">
                    {{ __('Properties (Admin)') }}
                </x-responsive-nav-link>
            @endcan

            @can('manageProperties')
                <x-responsive-nav-link :href="route('properties.my')" :active="request()->routeIs('properties.my')" class="text-white hover:text-accent">
                    {{ __('My Properties') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('properties.create')" :active="request()->routeIs('properties.create')" class="text-white hover:text-accent">
                    {{ __('Add Property') }}
                </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.index')" class="text-white hover:text-accent">
                {{ __('Explore Properties') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-accent/50">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-accent">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home')" class="text-white hover:text-accent">
                    {{ __('Back to Site') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white hover:text-accent">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>