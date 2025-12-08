<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-graphite">Gestão de Imóveis</h2>
                        <a href="{{ route('properties.create') }}" class="bg-accent text-white px-4 py-2 rounded-lg hover:bg-accent/90 transition text-sm font-bold">
                            + Novo Imóvel
                        </a>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                        <form method="GET" action="{{ route('admin.properties') }}" class="flex gap-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título ou cidade..." class="flex-1 rounded-lg border-gray-300 text-sm">
                            <select name="status" class="rounded-lg border-gray-300 text-sm">
                                <option value="">Status</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publicado</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                            </select>
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black">Filtrar</button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imóvel</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Localização</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proprietário</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($properties as $property)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if($property->cover_image)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($property->cover_image) }}" alt="">
                                                @elseif($property->images && count($property->images) > 0)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($property->images[0]) }}" alt="">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-200"></div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($property->title, 30) }}</div>
                                                <div class="text-sm text-gray-500">{{ ucfirst($property->type) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $property->city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                        {{ $property->formatted_price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $property->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $property->status === 'published' ? 'Ativo' : 'Rascunho' }}
                                        </span>
                                        @if($property->is_exclusive)
                                            <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Exclusivo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $property->owner->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('properties.edit', $property) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                        <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhum imóvel encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>