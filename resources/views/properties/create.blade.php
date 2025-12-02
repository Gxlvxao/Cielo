<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Novo Imóvel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título do Imóvel</label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                value="{{ old('title') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                placeholder="Ex: Apartamento T3 com Vista Mar"
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                placeholder="Descreva o imóvel em detalhes..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type and Transaction Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Imóvel</label>
                                <select 
                                    id="type" 
                                    name="type" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                                    <option value="">Selecione...</option>
                                    <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartamento</option>
                                    <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>Moradia</option>
                                    <option value="land" {{ old('type') == 'land' ? 'selected' : '' }}>Terreno</option>
                                    <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>Comercial</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="transaction_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Transação</label>
                                <select 
                                    id="transaction_type" 
                                    name="transaction_type" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                                    <option value="">Selecione...</option>
                                    <option value="sale" {{ old('transaction_type') == 'sale' ? 'selected' : '' }}>Venda</option>
                                    <option value="rent" {{ old('transaction_type') == 'rent' ? 'selected' : '' }}>Arrendamento</option>
                                </select>
                                @error('transaction_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Preço (€)</label>
                            <input 
                                type="number" 
                                id="price" 
                                name="price" 
                                value="{{ old('price') }}"
                                required
                                min="0"
                                step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                placeholder="250000"
                            >
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Cidade</label>
                                <select 
                                    id="city" 
                                    name="city" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                                    <option value="">Selecione...</option>
                                    <option value="Lisboa" {{ old('city') == 'Lisboa' ? 'selected' : '' }}>Lisboa</option>
                                    <option value="Porto" {{ old('city') == 'Porto' ? 'selected' : '' }}>Porto</option>
                                    <option value="Coimbra" {{ old('city') == 'Coimbra' ? 'selected' : '' }}>Coimbra</option>
                                    <option value="Braga" {{ old('city') == 'Braga' ? 'selected' : '' }}>Braga</option>
                                    <option value="Faro" {{ old('city') == 'Faro' ? 'selected' : '' }}>Faro</option>
                                    <option value="Leiria" {{ old('city') == 'Leiria' ? 'selected' : '' }}>Leiria</option>
                                </select>
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700 mb-2">Distrito/Freguesia</label>
                                <input 
                                    type="text" 
                                    id="district" 
                                    name="district" 
                                    value="{{ old('district') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                    placeholder="Ex: Cascais"
                                >
                                @error('district')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Endereço</label>
                            <input 
                                type="text" 
                                id="address" 
                                name="address" 
                                value="{{ old('address') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                placeholder="Rua, número, etc."
                            >
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Property Details -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Quartos</label>
                                <input 
                                    type="number" 
                                    id="bedrooms" 
                                    name="bedrooms" 
                                    value="{{ old('bedrooms') }}"
                                    min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                            </div>

                            <div>
                                <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Casas de Banho</label>
                                <input 
                                    type="number" 
                                    id="bathrooms" 
                                    name="bathrooms" 
                                    value="{{ old('bathrooms') }}"
                                    min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                            </div>

                            <div>
                                <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Área (m²)</label>
                                <input 
                                    type="number" 
                                    id="area" 
                                    name="area" 
                                    value="{{ old('area') }}"
                                    min="0"
                                    step="0.01"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                            </div>

                            <div>
                                <label for="year_built" class="block text-sm font-medium text-gray-700 mb-2">Ano</label>
                                <input 
                                    type="number" 
                                    id="year_built" 
                                    name="year_built" 
                                    value="{{ old('year_built') }}"
                                    min="1800"
                                    max="{{ date('Y') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                >
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp para Contato</label>
                            <input 
                                type="text" 
                                id="whatsapp" 
                                name="whatsapp" 
                                value="{{ old('whatsapp') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                placeholder="+351 912 345 678"
                            >
                            <p class="mt-1 text-sm text-gray-500">Número de WhatsApp para clientes interessados entrarem em contato</p>
                            @error('whatsapp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Imagens do Imóvel</label>
                            <input 
                                type="file" 
                                id="images" 
                                name="images[]" 
                                multiple
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                            >
                            <p class="mt-1 text-sm text-gray-500">Selecione até 10 imagens (máximo 5MB cada)</p>
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Exclusive Checkbox -->
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="is_exclusive" 
                                name="is_exclusive" 
                                value="1"
                                {{ old('is_exclusive') ? 'checked' : '' }}
                                class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent"
                            >
                            <label for="is_exclusive" class="ml-2 block text-sm text-gray-700">
                                <span class="font-medium">Imóvel Exclusivo</span>
                                <span class="text-gray-500 block">Apenas usuários logados poderão visualizar este imóvel</span>
                            </label>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <button type="submit" class="flex-1 bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Publicar Imóvel
                            </button>
                            <a href="{{ route('properties.my') }}" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
