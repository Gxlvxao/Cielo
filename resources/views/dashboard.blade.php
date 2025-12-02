<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->isAdmin())
                <!-- Admin Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-graphite mb-4">Bem-vindo, Administrador!</h3>
                        <p class="text-gray-600 mb-6">Gerencie o sistema através das opções abaixo.</p>
                        <div class="grid md:grid-cols-3 gap-4">
                            <a href="{{ route('admin.dashboard') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Painel Admin
                            </a>
                            <a href="{{ route('admin.access-requests') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Pedidos de Acesso
                            </a>
                            <a href="{{ route('admin.properties') }}" class="bg-graphite hover:bg-graphite/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Gestão de Imóveis
                            </a>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->isDeveloper())
                <!-- Developer Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-graphite mb-4">Bem-vindo, Developer!</h3>
                        <p class="text-gray-600 mb-6">Gerencie seus imóveis através das opções abaixo.</p>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="{{ route('properties.my') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Meus Imóveis
                            </a>
                            <a href="{{ route('properties.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Adicionar Imóvel
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Client Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-graphite mb-4">Bem-vindo!</h3>
                        <p class="text-gray-600 mb-6">Explore nosso catálogo de imóveis exclusivos.</p>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="{{ route('properties.index') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Ver Todos os Imóveis
                            </a>
                            <a href="{{ route('properties.index', ['city' => 'Lisboa']) }}" class="bg-graphite hover:bg-graphite/90 text-white font-semibold py-4 px-6 rounded-lg transition-colors text-center">
                                Imóveis em Lisboa
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Links -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-graphite mb-4">Links Rápidos</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <a href="{{ route('properties.index') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-accent hover:bg-accent/5 transition-colors">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-graphite">Explorar Imóveis</p>
                                <p class="text-sm text-gray-500">Ver catálogo completo</p>
                            </div>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-accent hover:bg-accent/5 transition-colors">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-graphite">Meu Perfil</p>
                                <p class="text-sm text-gray-500">Editar informações</p>
                            </div>
                        </a>
                        <a href="{{ route('home') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-accent hover:bg-accent/5 transition-colors">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-graphite">Página Inicial</p>
                                <p class="text-sm text-gray-500">Voltar ao site</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
