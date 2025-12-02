<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Imóveis
            </h2>
            <a href="{{ route('properties.create') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Adicionar Imóvel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($properties->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <!-- Property Image -->
                            <div class="relative aspect-[4/3]">
                                @if($property->first_image)
                                    <img src="{{ asset('storage/' . $property->first_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    @if($property->status === 'published')
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Publicado
                                        </span>
                                    @else
                                        <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Rascunho
                                        </span>
                                    @endif
                                </div>

                                <!-- Exclusive Badge -->
                                @if($property->is_exclusive)
                                    <div class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        Exclusivo
                                    </div>
                                @endif
                            </div>

                            <!-- Property Info -->
                            <div class="p-6">
                                <div class="mb-2">
                                    <span class="text-xs font-medium text-accent uppercase">{{ $property->city }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-graphite mb-2 line-clamp-1">{{ $property->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $property->description }}</p>
                                
                                <!-- Property Features -->
                                <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                                    @if($property->bedrooms)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span>{{ $property->bedrooms }}</span>
                                        </div>
                                    @endif
                                    @if($property->bathrooms)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                            </svg>
                                            <span>{{ $property->bathrooms }}</span>
                                        </div>
                                    @endif
                                    @if($property->area)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                            </svg>
                                            <span>{{ $property->area }}m²</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Price and Actions -->
                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-2xl font-bold text-accent mb-4">{{ $property->formatted_price }}</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('properties.show', $property) }}" class="flex-1 bg-graphite hover:bg-graphite/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm text-center" target="_blank">
                                            Ver
                                        </a>
                                        <a href="{{ route('properties.edit', $property) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm text-center">
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete({{ $property->id }})" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Nenhum imóvel cadastrado</h3>
                    <p class="text-gray-500 mb-6">Comece adicionando seu primeiro imóvel</p>
                    <a href="{{ route('properties.create') }}" class="inline-block bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        Adicionar Primeiro Imóvel
                    </a>
                </div>
            @endif
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
            form.action = `/properties/${propertyId}`;
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
