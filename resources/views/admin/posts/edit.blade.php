<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-heading font-semibold text-xl text-graphite leading-tight">
                {{ __('Editar Artigo') }}: <span class="text-gray-500 text-base font-normal">{{ $post->title }}</span>
            </h2>
            <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Voltar para listagem
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                
                <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="__('Título')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category" :value="__('Categoria')" />
                        <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-[#C9A35E] focus:ring-[#C9A35E] rounded-md shadow-sm">
                            @foreach(['arquitetura' => 'Arquitetura', 'estilo_vida' => 'Estilo de Vida', 'feng_shui' => 'Feng Shui no Lar', 'mercado_luxo' => 'Mercado de Luxo'] as $key => $label)
                                <option value="{{ $key }}" {{ old('category', $post->category) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Imagem de Capa (Deixe vazio para manter a atual)')" />
                        
                        @if($post->image_path)
                            <div class="mt-2 mb-4">
                                <p class="text-xs text-gray-500 mb-1">Imagem Atual:</p>
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Capa atual" class="w-48 h-32 object-cover rounded-md shadow-sm border border-gray-200">
                            </div>
                        @endif

                        <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-[#C9A35E] hover:file:bg-yellow-100 transition">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Conteúdo do Artigo')" />
                        <textarea name="content" id="content" rows="12" class="block mt-1 w-full border-gray-300 focus:border-[#C9A35E] focus:ring-[#C9A35E] rounded-md shadow-sm font-serif text-gray-700 leading-relaxed" required>{{ old('content', $post->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" 
                                   {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[#C9A35E] shadow-sm focus:ring-[#C9A35E]">
                            <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">Destacar este artigo na Home</label>
                        </div>

                        <div>
                            <x-input-label for="published_at" :value="__('Data de Publicação')" />
                            <input type="date" name="published_at" id="published_at" 
                                   value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d') : '') }}"
                                   class="block w-full border-gray-300 focus:border-[#C9A35E] focus:ring-[#C9A35E] rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition shadow-sm">
                            Cancelar
                        </a>
                        
                        <button type="submit" 
                                style="background-color: #C9A35E; color: white;"
                                class="inline-flex items-center px-6 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:opacity-90 active:opacity-100 focus:outline-none focus:ring-2 focus:ring-[#C9A35E] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            Atualizar Artigo
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>