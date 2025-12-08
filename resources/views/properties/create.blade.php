<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight font-heading">
            Novo Cadastro de Imóvel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Informações Principais</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Título do Anúncio</label>
                                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent" placeholder="Ex: Penthouse de Luxo com Vista Mar">
                                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição Detalhada</label>
                                    <textarea name="description" rows="5" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent" placeholder="Descreva os diferenciais..."></textarea>
                                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Imóvel</label>
                                        <select name="type" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                            <option value="">Selecione...</option>
                                            <option value="apartment">Apartamento</option>
                                            <option value="house">Moradia</option>
                                            <option value="villa">Villa de Luxo</option>
                                            <option value="land">Terreno</option>
                                            <option value="commercial">Comercial</option>
                                            <option value="office">Escritório</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Transação</label>
                                        <select name="transaction_type" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                            <option value="sale">Venda</option>
                                            <option value="rent">Arrendamento</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Condição</label>
                                        <select name="condition" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                            <option value="new">Novo / A Estrear</option>
                                            <option value="used">Usado</option>
                                            <option value="renovated">Renovado</option>
                                            <option value="under_construction">Em Construção</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Preço (€)</label>
                                        <input type="number" name="price" value="{{ old('price') }}" required min="0" step="0.01" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent font-bold text-graphite" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Características e Áreas</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Quartos</label>
                                    <input type="number" name="bedrooms" min="0" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Banheiros</label>
                                    <input type="number" name="bathrooms" min="0" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Área Útil (m²)</label>
                                    <input type="number" name="area" min="0" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Terreno (m²)</label>
                                    <input type="number" name="land_area" min="0" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Ano Constr.</label>
                                    <input type="number" name="year_built" min="1800" max="{{ date('Y') }}" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Cert. Energética</label>
                                    <select name="energy_rating" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                        <option value="">-</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Localização</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                    <select name="city" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                        <option value="Lisboa">Lisboa</option>
                                        <option value="Porto">Porto</option>
                                        <option value="Cascais">Cascais</option>
                                        <option value="Sintra">Sintra</option>
                                        <option value="Faro">Faro</option>
                                        <option value="Coimbra">Coimbra</option>
                                        <option value="Braga">Braga</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Freguesia/Bairro</label>
                                    <input type="text" name="district" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent" placeholder="Ex: Estoril">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Morada Completa</label>
                                    <input type="text" name="address" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                                    <input type="text" name="postal_code" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Mídia & Contato</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-accent mb-2">Foto de Capa (Destaque)</label>
                                <div class="border-2 border-dashed border-accent/30 bg-accent/5 rounded-lg p-4 text-center hover:bg-accent/10 transition-colors">
                                    <input type="file" name="cover_image" required accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-accent file:text-white hover:file:bg-accent/90">
                                    <p class="text-xs text-gray-500 mt-2">Esta será a imagem principal do anúncio.</p>
                                </div>
                                @error('cover_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Galeria de Fotos</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition-colors">
                                    <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-700">
                                    <p class="text-xs text-gray-400 mt-2">Adicione fotos extras do interior/exterior.</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vídeo / Tour Virtual (URL)</label>
                                <input type="url" name="video_url" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent" placeholder="https://youtube.com/...">
                                <p class="text-xs text-gray-500 mt-1">Suporta YouTube e Vimeo.</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-green-700 mb-1 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    WhatsApp Comercial
                                </label>
                                <input type="text" name="whatsapp" class="w-full rounded-lg border-green-200 focus:border-green-500 focus:ring-green-500 bg-green-50" placeholder="+351 912 345 678">
                            </div>
                        </div>

                        <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-white">
                            <h3 class="text-lg font-bold mb-4 border-b border-gray-600 pb-2">Visibilidade</h3>
                            <div class="flex items-start mb-4">
                                <div class="flex h-5 items-center">
                                    <input id="is_exclusive" name="is_exclusive" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-accent focus:ring-accent">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_exclusive" class="font-medium text-white">Exclusivo (Off-Market)</label>
                                    <p class="text-gray-400">Apenas membros logados poderão ver este imóvel.</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-accent hover:bg-accent/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all transform hover:scale-105">
                                Publicar Imóvel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>