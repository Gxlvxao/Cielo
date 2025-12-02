<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight">
            Painel de Controle do Administrador
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Banner -->
        <div class="bg-graphite text-white p-8 rounded-lg shadow-xl mb-8">
            <h1 class="text-3xl font-bold mb-2">Bem-vindo, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-300">Visão geral e ações rápidas para a gestão do sistema CROW GLOBAL.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Pending Requests -->
            <div class="bg-white rounded-lg shadow-md border-l-4 border-accent hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pedidos Pendentes</p>
                            <p class="text-3xl font-bold text-accent mt-2">{{ $stats['pending_requests'] }}</p>
                        </div>
                        <div class="bg-accent/10 p-3 rounded-full">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.access-requests') }}" class="text-sm text-accent hover:text-accent/80 font-medium mt-4 inline-block">
                        Analisar pedidos →
                    </a>
                </div>
            </div>

            <!-- Total Properties -->
            <div class="bg-white rounded-lg shadow-md border-l-4 border-graphite hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total de Imóveis</p>
                            <p class="text-3xl font-bold text-graphite mt-2">{{ $stats['total_properties'] }}</p>
                        </div>
                        <div class="bg-graphite/10 p-3 rounded-full">
                            <svg class="w-8 h-8 text-graphite" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.properties') }}" class="text-sm text-accent hover:text-accent/80 font-medium mt-4 inline-block">
                        Gerenciar imóveis →
                    </a>
                </div>
            </div>

            <!-- Published Properties -->
            <div class="bg-white rounded-lg shadow-md border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Imóveis Publicados</p>
                            <p class="text-3xl font-bold text-green-500 mt-2">{{ $stats['published_properties'] }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 3.042 1.135 5.824 3.04 7.938l3.18-3.18M21 12a9 9 0 00-9-9"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        {{ round(($stats['published_properties'] / max(1, $stats['total_properties'])) * 100, 1) }}% do total
                    </p>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-lg shadow-md border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total de Usuários</p>
                            <p class="text-3xl font-bold text-blue-500 mt-2">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        {{ $stats['developers'] }} Developers | {{ $stats['clients'] }} Clientes
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Access Requests -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <h3 class="text-xl font-semibold text-graphite">Últimos Pedidos de Acesso</h3>
                        <a href="{{ route('admin.access-requests') }}" class="text-sm text-accent hover:text-accent/80 font-medium">
                            Ver todos →
                        </a>
                    </div>
                    @if($recentRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentRequests as $request)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-graphite">{{ $request->user->name ?? 'Usuário Deletado' }}</p>
                                        <p class="text-sm text-gray-500">{{ $request->user->email ?? $request->email }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $request->requested_role === 'developer' ? 'Developer' : 'Cliente' }}
                                        </span>
                                        <p class="text-xs text-gray-400 mt-1">{{ $request->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Nenhum pedido pendente.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Properties -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <h3 class="text-xl font-semibold text-graphite">Últimos Imóveis Cadastrados</h3>
                        <a href="{{ route('admin.properties') }}" class="text-sm text-accent hover:text-accent/80 font-medium">
                            Ver todos →
                        </a>
                    </div>
                    @if($recentProperties->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentProperties as $property)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-graphite">{{ Str::limit($property->title, 30) }}</p>
                                        <p class="text-sm text-gray-500">{{ $property->city }} - {{ $property->owner->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-accent">{{ $property->formatted_price }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $property->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Nenhum imóvel cadastrado recentemente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
