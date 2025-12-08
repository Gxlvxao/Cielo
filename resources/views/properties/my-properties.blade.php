<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Imóveis
            </h2>
            <a href="{{ route('properties.create') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
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
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if($property->cover_image)
                                    <img src="{{ Storage::url($property->cover_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                @elseif($property->images && count($property->images) > 0)
                                    <img src="{{ Storage::url($property->images[0]) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                        {{ $property->status === 'published' ? 'Publicado' : 'Rascunho' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-graphite mb-1 truncate">{{ $property->title }}</h3>
                                <p class="text-gray-500 text-xs mb-4">{{ $property->city }}</p>
                                
                                <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                    <span class="font-bold text-accent">{{ $property->formatted_price }}</span>
                                    <div class="flex gap-2">
                                        <a href="{{ route('properties.edit', $property) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Editar</a>
                                        <button onclick="confirmDelete({{ $property->id }})" class="text-red-600 hover:text-red-800 text-sm font-medium">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $properties->links() }}</div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-500 mb-6">Nenhum imóvel cadastrado.</p>
                    <a href="{{ route('properties.create') }}" class="inline-block bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        Adicionar Primeiro Imóvel
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Excluir Imóvel?</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Esta ação não pode ser desfeita.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="ok-btn" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Excluir
                        </button>
                    </form>
                    <button onclick="closeDeleteModal()" class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </button>
                </div>
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
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>