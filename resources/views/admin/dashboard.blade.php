<x-app-layout>
    <div class="max-w-7xl mx-auto mb-8 py-12 px-6">
        <div class="bg-gradient-to-r from-graphite to-gray-800 rounded-2xl p-8 shadow-lg text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-accent opacity-10 rounded-full blur-3xl -mr-16 -mt-16"></div>
            <div class="relative z-10 md:flex md:items-center md:justify-between">
                <div>
                    <h2 class="text-3xl font-bold leading-tight font-heading mb-2">
                        {{ __('messages.welcome_back', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="text-gray-300 text-lg">Crow Command Center</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mt-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-yellow-50 rounded-lg p-3">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <span class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">{{ __('messages.action_needed') }}</span>
                    </div>
                    <div class="text-3xl font-bold text-graphite mb-1">{{ $stats['pending_requests'] }}</div>
                    <div class="text-sm text-gray-500 font-medium">{{ __('messages.pending_requests') }}</div>
                </div>
                <a href="{{ route('admin.access-requests') }}" class="block bg-gray-50 px-6 py-3 text-sm text-accent font-semibold hover:bg-gray-100 transition-colors">
                    {{ __('messages.view_all') }} &rarr;
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-50 rounded-lg p-3">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-graphite mb-1">{{ $stats['published_properties'] }}</div>
                    <div class="text-sm text-gray-500 font-medium">{{ __('messages.published') }}</div>
                </div>
                <a href="{{ route('admin.properties') }}" class="block bg-gray-50 px-6 py-3 text-sm text-accent font-semibold hover:bg-gray-100 transition-colors">
                    {{ __('messages.manage_catalog') }} &rarr;
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-50 rounded-lg p-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-graphite mb-1">{{ $stats['developers'] }}</div>
                    <div class="text-sm text-gray-500 font-medium">{{ __('messages.partners') }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-50 rounded-lg p-3">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-graphite mb-1">{{ $stats['clients'] }}</div>
                    <div class="text-sm text-gray-500 font-medium">{{ __('messages.investors') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>