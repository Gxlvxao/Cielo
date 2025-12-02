<x-public-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Image Gallery -->
        <section class="bg-graphite">
            <div class="container mx-auto px-4 py-8">
                @if($property->images && count($property->images) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-6xl mx-auto">
                        <!-- Main Image -->
                        <div class="md:col-span-2 aspect-[16/9] rounded-lg overflow-hidden">
                            <img 
                                id="mainImage"
                                src="{{ asset('storage/' . $property->images[0]) }}" 
                                alt="{{ $property->title }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <!-- Thumbnail Images -->
                        @if(count($property->images) > 1)
                            <div class="md:col-span-2 grid grid-cols-4 gap-2">
                                @foreach(array_slice($property->images, 0, 4) as $index => $image)
                                    <div class="aspect-[4/3] rounded-lg overflow-hidden cursor-pointer hover:opacity-75 transition-opacity" onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                                        <img 
                                            src="{{ asset('storage/' . $image) }}" 
                                            alt="{{ $property->title }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="max-w-6xl mx-auto aspect-[16/9] bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                @endif
            </div>
        </section>

        <!-- Property Details -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-lg shadow-sm p-8">
                                <!-- Badges -->
                                <div class="flex gap-2 mb-4">
                                    <span class="px-3 py-1 bg-accent/10 text-accent rounded-full text-sm font-semibold">
                                        {{ $property->city }}
                                    </span>
                                    @if($property->is_exclusive)
                                        <span class="px-3 py-1 bg-accent text-white rounded-full text-sm font-semibold">
                                            Exclusivo
                                        </span>
                                    @endif
                                    @if($property->is_featured)
                                        <span class="px-3 py-1 bg-graphite text-white rounded-full text-sm font-semibold">
                                            Destaque
                                        </span>
                                    @endif
                                </div>

                                <!-- Title and Price -->
                                <h1 class="text-3xl md:text-4xl font-bold text-graphite mb-2">{{ $property->title }}</h1>
                                <p class="text-gray-600 mb-6">{{ $property->address }}, {{ $property->city }}</p>
                                <div class="mb-8">
                                    <p class="text-4xl font-bold text-accent">{{ $property->formatted_price }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $property->transaction_type === 'sale' ? 'Venda' : 'Arrendamento' }}
                                    </p>
                                </div>

                                <!-- Property Features -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 pb-8 border-b border-gray-200">
                                    @if($property->bedrooms)
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <svg class="w-8 h-8 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <p class="text-2xl font-bold text-graphite">{{ $property->bedrooms }}</p>
                                            <p class="text-sm text-gray-600">Quartos</p>
                                        </div>
                                    @endif
                                    @if($property->bathrooms)
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <svg class="w-8 h-8 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                            </svg>
                                            <p class="text-2xl font-bold text-graphite">{{ $property->bathrooms }}</p>
                                            <p class="text-sm text-gray-600">Casas de Banho</p>
                                        </div>
                                    @endif
                                    @if($property->area)
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <svg class="w-8 h-8 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                            </svg>
                                            <p class="text-2xl font-bold text-graphite">{{ $property->area }}</p>
                                            <p class="text-sm text-gray-600">m²</p>
                                        </div>
                                    @endif
                                    @if($property->year_built)
                                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                                            <svg class="w-8 h-8 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-2xl font-bold text-graphite">{{ $property->year_built }}</p>
                                            <p class="text-sm text-gray-600">Ano</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div class="mb-8">
                                    <h2 class="text-2xl font-bold text-graphite mb-4">Descrição</h2>
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $property->description }}</p>
                                </div>

                                <!-- Property Type -->
                                <div class="mb-8">
                                    <h2 class="text-2xl font-bold text-graphite mb-4">Informações</h2>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Tipo de Imóvel</p>
                                            <p class="font-semibold text-graphite">
                                                @switch($property->type)
                                                    @case('apartment') Apartamento @break
                                                    @case('house') Moradia @break
                                                    @case('land') Terreno @break
                                                    @case('commercial') Comercial @break
                                                @endswitch
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Tipo de Transação</p>
                                            <p class="font-semibold text-graphite">
                                                {{ $property->transaction_type === 'sale' ? 'Venda' : 'Arrendamento' }}
                                            </p>
                                        </div>
                                        @if($property->district)
                                            <div>
                                                <p class="text-sm text-gray-600">Distrito/Freguesia</p>
                                                <p class="font-semibold text-graphite">{{ $property->district }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar - Contact -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                                <h3 class="text-xl font-bold text-graphite mb-4">Interessado?</h3>
                                <p class="text-gray-600 mb-6">Entre em contato conosco para mais informações sobre este imóvel.</p>
                                
                                @if($property->whatsapp)
                                    <a 
                                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $property->whatsapp) }}?text=Olá! Tenho interesse no imóvel: {{ $property->title }}" 
                                        target="_blank"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 mb-3"
                                    >
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                        Contatar via WhatsApp
                                    </a>
                                @endif

                                <a 
                                    href="{{ route('properties.index') }}"
                                    class="w-full bg-graphite hover:bg-graphite/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2"
                                >
                                    Ver Mais Imóveis
                                </a>

                                <!-- Property Owner Info -->
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <p class="text-sm text-gray-600 mb-2">Anunciado por:</p>
                                    <p class="font-semibold text-graphite">{{ $property->owner->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function changeMainImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }
    </script>
</x-public-layout>
