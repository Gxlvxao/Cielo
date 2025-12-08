<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight font-heading">
            Editar Imóvel: {{ $property->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('properties.update', $property) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Informações Principais</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                                    <input type="text" name="title" value="{{ old('title', $property->title) }}" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                                    <textarea name="description" rows="5" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">{{ old('description', $property->description) }}</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Preço (€)</label>
                                        <input type="number" name="price" value="{{ old('price', $property->price) }}" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                                        <select name="type" class="w-full rounded-lg border-gray-300">
                                            @foreach(['apartment','house','villa','land','commercial','office'] as $t)
                                                <option value="{{ $t }}" {{ $property->type == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Transação</label>
                                        <select name="transaction_type" class="w-full rounded-lg border-gray-300">
                                            <option value="sale" {{ $property->transaction_type == 'sale' ? 'selected' : '' }}>Venda</option>
                                            <option value="rent" {{ $property->transaction_type == 'rent' ? 'selected' : '' }}>Arrendamento</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">Localização & Detalhes</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="city" value="{{ $property->city }}" placeholder="Cidade" class="w-full rounded-lg border-gray-300">
                                <input type="text" name="address" value="{{ $property->address }}" placeholder="Endereço" class="w-full rounded-lg border-gray-300">
                                <input type="number" name="bedrooms" value="{{ $property->bedrooms }}" placeholder="Quartos" class="w-full rounded-lg border-gray-300">
                                <input type="number" name="area" value="{{ $property->area }}" placeholder="Área (m2)" class="w-full rounded-lg border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4">Capa Atual</h3>
                            @if($property->cover_image)
                                <img src="{{ Storage::url($property->cover_image) }}" class="w-full h-48 object-cover rounded-lg mb-4 shadow-sm">
                            @endif
                            
                            <label class="block text-sm font-medium text-accent mb-2">Alterar Capa</label>
                            <input type="file" name="cover_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-accent file:text-white hover:file:bg-accent/90">
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4">Galeria</h3>
                            
                            @if($property->images && count($property->images) > 0)
                                <div class="grid grid-cols-2 gap-2 mb-4">
                                    @foreach($property->images as $img)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($img) }}" class="w-full h-24 object-cover rounded-lg">
                                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                                <label class="flex items-center gap-1 text-white text-xs cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]" value="{{ $img }}" class="text-red-500 rounded focus:ring-red-500">
                                                    Excluir
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-400 mb-4">Selecione para excluir ao salvar.</p>
                            @endif

                            <label class="block text-sm font-medium text-gray-700 mb-2">Adicionar Mais Fotos</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-700">
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vídeo URL</label>
                                <input type="url" name="video_url" value="{{ old('video_url', $property->video_url) }}" class="w-full rounded-lg border-gray-300">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $property->whatsapp) }}" class="w-full rounded-lg border-gray-300">
                            </div>
                        </div>

                        <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
                            <button type="submit" class="w-full bg-accent hover:bg-accent/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all transform hover:scale-105">
                                Salvar Alterações
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>