<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight">
            Gestão de Imóveis (Admin)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-xl p-6 mb-6 border-t-4 border-accent">
            <h3 class="text-lg font-semibold text-graphite mb-4">Filtros Avançados</h3>
            <form method="GET" action="{{ route('admin.properties') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesquisar (Título, Cidade, Descrição)</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Ex: Apartamento T3 em Lisboa" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                    >
                </div>
                
                <!-- City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cidade</label>
                    <select name="city" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">Todas</option>
                        <option value="Lisboa" {{ request('city') == 'Lisboa' ? 'selected' : '' }}>Lisboa</option>
                        <option value="Porto" {{ request('city') == 'Porto' ? 'selected' : '' }}>Porto</option>
                        <option value="Coimbra" {{ request('city') == 'Coimbra' ? 'selected' : '' }}>Coimbra</option>
                        <option value="Braga" {{ request('city') == 'Braga' ? 'selected' : '' }}>Braga</option>
                        <option value="Faro" {{ request('city') == 'Faro' ? 'selected' : '' }}>Faro</option>
                        <option value="Leiria" {{ request('city') == 'Leiria' ? 'selected' : '' }}>Leiria</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">Todos</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Rascunho</option>
                    </select>
                </div>

                <!-- Exclusive -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Exclusivo</label>
                    <select name="is_exclusive" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">Todos</option>
                        <option value="1" {{ request('is_exclusive') == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ request('is_exclusive') == '0' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <!-- Property Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                    <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">Todos</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartamento</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>Moradia</option>
                        <option value="land" {{ request('type') == 'land' ? 'selected' : '' }}>Terreno</option>
                        <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Comercial</option>
                    </select>
                </div>

                <!-- Transaction Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transação</label>
                    <select name="transaction_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                        <option value="">Todas</option>
                        <option value="sale" {{ request('transaction_type') == 'sale' ? 'selected' : '' }}>Venda</option>
                        <option value="rent" {{ request('transaction_type') == 'rent' ? 'selected' : '' }}>Arrendamento</option>
                    </select>
                </div>

                <!-- Min/Max Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preço Mínimo (€)</label>
                    <input 
                        type="number" 
                        name="min_price" 
                        value="{{ request('min_price') }}"
                        placeholder="100000" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preço Máximo (€)</label>
                    <input 
                        type="number" 
                        name="max_price" 
                        value="{{ request('max_price') }}"
                        placeholder="500000" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="md:col-span-5 flex justify-end gap-2 mt-4">
                    <button type="submit" class="bg-accent hover:bg-accent/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors shadow-md">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Aplicar Filtros
                    </button>
                    <a href="{{ route('admin.properties') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Limpar Filtros
                    </a>
                </div>
            </form>
        </div>

        <!-- Properties Table -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-graphite/5">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-graphite uppercase tracking-wider">Imóvel</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-graphite uppercase tracking-wider">Localização</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-graphite uppercase tracking-wider">Preço</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-graphite uppercase tracking-wider">Proprietário</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-graphite uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-graphite uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($properties as $property)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($property->first_image)
                                            <img src="{{ asset('storage/' . $property->first_image) }}" alt="{{ $property->title }}" class="w-16 h-16 rounded object-cover mr-3 border border-gray-200">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded mr-3 flex items-center justify-center border border-gray-200">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-graphite">{{ Str::limit($property->title, 40) }}</div>
                                            <div class="text-xs text-gray-500">{{ $property->type }} | {{ $property->transaction_type }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $property->city }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-accent">
                                    {{ $property->formatted_price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-graphite">{{ $property->owner->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $property->owner->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        @if($property->status === 'published')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Rascunho
                                            </span>
                                        @endif
                                        @if($property->is_exclusive)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-accent/10 text-accent">
                                                Exclusivo
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('properties.show', $property) }}" class="text-accent hover:text-accent/80 mr-3 font-semibold" target="_blank">Ver</a>
                                    <button onclick="confirmDelete({{ $property->id }})" class="text-red-600 hover:text-red-900 font-semibold">Excluir</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Nenhum imóvel encontrado com os filtros aplicados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Confirmar Exclusão</h3>
                <p class="text-sm text-gray-500 mb-4">
                    Tem certeza que deseja excluir este imóvel? Esta ação não pode ser desfeita.
                </p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Confirmar
                        </button>
                        <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(propertyId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/properties/${propertyId}`;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
