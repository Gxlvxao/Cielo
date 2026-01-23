<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-cielo-dark leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- ======================== --}}
    {{-- VISÃO DO PARCEIRO (DEV) --}}
    {{-- ======================== --}}
    @if(Auth::user()->role === 'developer')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="text-gray-500 text-xs uppercase tracking-widest font-bold">Meus Imóveis</div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="text-3xl font-serif text-cielo-dark">{{ Auth::user()->properties()->count() }}</span>
                    <span class="text-sm text-gray-400">Ativos</span>
                </div>
                <a href="{{ route('properties.create') }}" class="mt-4 block text-center bg-cielo-dark text-white text-xs font-bold py-2 rounded hover:bg-cielo-terracotta transition-colors">
                    + Adicionar Imóvel
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="text-gray-500 text-xs uppercase tracking-widest font-bold">Clientes / Leads</div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="text-3xl font-serif text-cielo-dark">{{ Auth::user()->clients()->count() }}</span>
                    <span class="text-sm text-gray-400">Registados</span>
                </div>
                <a href="{{ route('developer.clients') }}" class="mt-4 block text-center border border-cielo-dark text-cielo-dark text-xs font-bold py-2 rounded hover:bg-gray-50 transition-colors">
                    Ver Lista
                </a>
            </div>

            <div class="bg-cielo-terracotta p-6 rounded-2xl shadow-lg text-white">
                <div class="text-white/80 text-xs uppercase tracking-widest font-bold">Status da Conta</div>
                <div class="mt-2 text-2xl font-serif">Parceiro Verificado</div>
                <p class="mt-2 text-xs text-white/70">A sua conta tem permissões para publicar imóveis na rede Private.</p>
            </div>
        </div>
    @endif

    {{-- ======================== --}}
    {{-- VISÃO DO CLIENTE         --}}
    {{-- ======================== --}}
    @if(Auth::user()->role === 'client')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8 text-center">
            <h3 class="font-serif text-2xl text-cielo-dark mb-4">Bem-vindo à sua área privada, {{ Auth::user()->name }}.</h3>
            <p class="text-gray-500 max-w-lg mx-auto mb-8">
                Aqui você pode acompanhar oportunidades exclusivas, usar nossos simuladores fiscais e gerir seus dados de acesso.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('properties.index') }}" class="px-6 py-3 bg-cielo-dark text-white rounded-lg font-medium hover:bg-cielo-terracotta transition-colors">
                    Explorar Imóveis
                </a>
                <a href="{{ route('tools.gains') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:border-cielo-terracotta hover:text-cielo-terracotta transition-colors">
                    Simular Impostos
                </a>
            </div>
        </div>
    @endif

</x-app-layout>