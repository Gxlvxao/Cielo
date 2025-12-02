<x-public-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section with Search -->
        <section class="bg-gradient-to-br from-graphite via-graphite/95 to-graphite py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center text-white mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        @if(request('city'))
                            Imóveis em {{ request('city') }}
                        @else
                            Todos os Imóveis
                        @endif
                    </h1>
                    <p class="text-lg text-white/80">
                        Encontre o imóvel perfeito para você
                    </p>
                </div>

                <!-- Search and Filters -->
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-6xl mx-auto">
                    <form method="GET" action="{{ route('properties.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- City Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cidade</label>
                                <select name="city" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                                    <option value="">Todas as cidades</option>
                                    <option value="Lisboa" {{ request('city') == 'Lisboa' ? 'selected' : '' }}>Lisboa</option>
                                    <option value="Porto" {{ request('city') == 'Porto' ? 'selected' : '' }}>Porto</option>
                                    <option value="Coimbra" {{ request('city') == 'Coimbra' ? 'selected' : '' }}>Coimbra</option>
                                    <option value="Braga" {{ request('city') == 'Braga' ? 'selected' : '' }}>Braga</option>
                                    <option value="Faro" {{ request('city') == 'Faro' ? 'selected' : '' }}>Faro</option>
                                    <option value="Leiria" {{ request('city') == 'Leiria' ? 'selected' : '' }}>Leiria</option>
                                </select>
                            </div>

                            <!-- Type Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                                    <option value="">Todos os tipos</option>
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
                                    <option value="">Comprar/Arrendar</option>
                                    <option value="sale" {{ request('transaction_type') == 'sale' ? 'selected' : '' }}>Comprar</option>
                                    <option value="rent" {{ request('transaction_type') == 'rent' ? 'selected' : '' }}>Arrendar</option>
                                </select>
                            </div>

                            <!-- Bedrooms Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Quartos</label>
                                <select name="bedrooms" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                                    <option value="">Qualquer</option>
                                    <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1+</option>
                                    <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2+</option>
                                    <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3+</option>
                                    <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4+</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Pesquisar
                            </button>
                            <a href="{{ route('properties.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Properties Grid -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-gray-600">
                            <span class="font-semibold text-graphite">{{ $properties->total() }}</span> imóveis encontrados
                        </p>
                    </div>
                    @auth
                        @if(auth()->user()->canManageProperties())
                            <a href="{{ route('properties.create') }}" class="bg-accent hover:bg-accent/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Adicionar Imóvel
                            </a>
                        @endif
                    @endauth
                </div>

                @if($properties->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($properties as $property)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                                    
                                    <!-- Exclusive Badge -->
                                    @if($property->is_exclusive)
                                        <div class="absolute top-4 left-4 bg-accent text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Exclusivo
                                        </div>
                                    @endif

                                    <!-- Featured Badge -->
                                    @if($property->is_featured)
                                        <div class="absolute top-4 right-4 bg-graphite text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Destaque
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

                                    <!-- Price and Action -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                        <div>
                                            <p class="text-2xl font-bold text-accent">{{ $property->formatted_price }}</p>
                                        </div>
                                        <a href="{{ route('properties.show', $property) }}" class="bg-graphite hover:bg-graphite/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                                            Ver Detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $properties->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">Nenhum imóvel encontrado</h3>
                        <p class="text-gray-500 mb-6">Tente ajustar os filtros de pesquisa</p>
                        <a href="{{ route('properties.index') }}" class="inline-block bg-accent hover:bg-accent/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                            Ver todos os imóveis
                        </a>
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-public-layout>
