<x-public-layout>
    @include('components.header')

    <main class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-heading font-bold text-graphite">Nosso Portfólio</h2>
                <p class="text-gray-500 mt-2">Explore as melhores oportunidades de investimento.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
                <form method="GET" action="{{ route('properties.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <select name="city" class="rounded-lg border-gray-300">
                        <option value="">Todas as Cidades</option>
                        <option value="Lisboa" {{ request('city') == 'Lisboa' ? 'selected' : '' }}>Lisboa</option>
                        <option value="Porto" {{ request('city') == 'Porto' ? 'selected' : '' }}>Porto</option>
                        <option value="Cascais" {{ request('city') == 'Cascais' ? 'selected' : '' }}>Cascais</option>
                    </select>
                    <select name="type" class="rounded-lg border-gray-300">
                        <option value="">Todos os Tipos</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartamento</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>Moradia</option>
                        <option value="villa" {{ request('type') == 'villa' ? 'selected' : '' }}>Villa</option>
                    </select>
                    <select name="transaction_type" class="rounded-lg border-gray-300">
                        <option value="">Objetivo</option>
                        <option value="sale" {{ request('transaction_type') == 'sale' ? 'selected' : '' }}>Comprar</option>
                        <option value="rent" {{ request('transaction_type') == 'rent' ? 'selected' : '' }}>Alugar</option>
                    </select>
                    <button type="submit" class="bg-graphite text-white font-bold py-2 px-4 rounded-lg hover:bg-black transition-colors">
                        Filtrar
                    </button>
                </form>
            </div>

            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($properties as $property)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <a href="{{ route('properties.show', $property) }}">
                                    @if($property->cover_image)
                                        <img src="{{ Storage::url($property->cover_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @elseif($property->images && count($property->images) > 0)
                                        <img src="{{ Storage::url($property->images[0]) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">Sem imagem</span>
                                        </div>
                                    @endif
                                </a>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-graphite px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">
                                        {{ $property->type }}
                                    </span>
                                </div>

                                @if($property->is_exclusive)
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-accent text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">
                                            Exclusivo
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-bold text-graphite line-clamp-1 group-hover:text-accent transition-colors">
                                        <a href="{{ route('properties.show', $property) }}">{{ $property->title }}</a>
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-sm mb-4 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $property->city }}
                                </p>

                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
                                    <span class="flex items-center gap-1"><span class="font-bold">{{ $property->bedrooms }}</span> Quartos</span>
                                    <span class="flex items-center gap-1"><span class="font-bold">{{ $property->area }}</span> m²</span>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="text-xl font-bold text-graphite">{{ $property->formatted_price }}</span>
                                    <a href="{{ route('properties.show', $property) }}" class="text-accent font-medium hover:underline text-sm">Ver Detalhes &rarr;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Nenhum imóvel encontrado com esses critérios.</p>
                </div>
            @endif
        </div>
    </main>

    @include('components.footer')
</x-public-layout>