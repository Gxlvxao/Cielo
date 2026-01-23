<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-xl text-cielo-dark leading-tight">
            {{ __('messages.property_management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Mensagens de Sucesso --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">{{ __('messages.property_list') ?? 'Lista de Imóveis' }}</h2>
                        <a href="{{ route('properties.create') }}" class="bg-cielo-terracotta text-white px-4 py-2 rounded-lg hover:bg-cielo-terracotta/90 transition text-sm font-bold shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            {{ __('messages.new_property') }}
                        </a>
                    </div>
                    
                    {{-- Filtros --}}
                    <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                        <form method="GET" action="{{ route('admin.properties') }}" class="flex flex-col sm:flex-row gap-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}" class="flex-1 rounded-lg border-gray-300 text-sm focus:border-cielo-terracotta focus:ring-cielo-terracotta">
                            <select name="status" class="rounded-lg border-gray-300 text-sm focus:border-cielo-terracotta focus:ring-cielo-terracotta">
                                <option value="">{{ __('messages.status') }}</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                                <option value="negotiating" {{ request('status') === 'negotiating' ? 'selected' : '' }}>{{ __('messages.negotiating') }}</option>
                            </select>
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black transition-colors">{{ __('messages.filter') }}</button>
                        </form>
                    </div>

                    {{-- Tabela --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.property') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.location') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Energia da Semana</th> {{-- Nova Coluna --}}
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.status') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.owner') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($properties as $property)
                                <tr>
                                    {{-- Imóvel --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $property->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $property->type }}</div>
                                    </td>

                                    {{-- Localização --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $property->city }}</td>

                                    {{-- COLUNA NOVIDADE: Energia da Semana --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{-- Só mostra o botão se o imóvel estiver ativo --}}
                                        @if($property->status === 'active')
                                            <form action="{{ route('admin.properties.toggle-energy', $property) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                
                                                <button type="submit" 
                                                        class="transition-all duration-300 p-2 rounded-full hover:bg-gray-100 {{ $property->is_energy_of_week ? 'text-yellow-500' : 'text-gray-300 hover:text-yellow-400' }}"
                                                        title="{{ $property->is_energy_of_week ? 'Remover Destaque' : 'Definir como Energia da Semana' }}">
                                                    
                                                    <svg class="w-6 h-6 {{ $property->is_energy_of_week ? 'fill-current' : 'fill-none stroke-current' }}" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            @if($property->is_energy_of_week)
                                                <span class="block text-[9px] uppercase tracking-widest text-yellow-600 font-bold mt-1">Destaque</span>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-300" title="Ative o imóvel primeiro">-</span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                                            {{ $property->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </td>

                                    {{-- Dono --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $property->owner->name ?? 'Sistema' }}
                                    </td>

                                    {{-- Ações --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('properties.edit', $property) }}" class="text-cielo-terracotta hover:text-cielo-dark mr-3 transition-colors font-bold">{{ __('messages.edit') }}</a>
                                        
                                        <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja apagar este imóvel?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400">{{ __('messages.no_properties') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Paginação (se houver) --}}
                    @if($properties instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-4">
                            {{ $properties->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>