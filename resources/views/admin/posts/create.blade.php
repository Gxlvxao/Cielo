<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Artigo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- O segredo está aqui: enctype="multipart/form-data" para a imagem funcionar --}}
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Título --}}
                    <div>
                        <x-input-label for="title" :value="__('Título')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Categoria --}}
                    <div>
                        <x-input-label for="category" :value="__('Categoria')" />
                        <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-cielo-terracotta focus:ring-cielo-terracotta rounded-md shadow-sm">
                            <option value="arquitetura" {{ old('category') == 'arquitetura' ? 'selected' : '' }}>Arquitetura</option>
                            <option value="estilo_vida" {{ old('category') == 'estilo_vida' ? 'selected' : '' }}>Estilo de Vida</option>
                            <option value="feng_shui" {{ old('category') == 'feng_shui' ? 'selected' : '' }}>Feng Shui no Lar</option>
                            <option value="mercado_luxo" {{ old('category') == 'mercado_luxo' ? 'selected' : '' }}>Mercado de Luxo</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    {{-- Imagem de Capa --}}
                    <div>
                        <x-input-label for="image" :value="__('Imagem de Capa')" />
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 
                            file:mr-4 file:py-2 file:px-4 
                            file:rounded-full file:border-0 
                            file:text-sm file:font-semibold 
                            file:bg-cielo-terracotta/10 file:text-cielo-terracotta 
                            hover:file:bg-cielo-terracotta/20" required>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    {{-- Conteúdo --}}
                    <div>
                        <x-input-label for="content" :value="__('Conteúdo do Artigo')" />
                        <textarea name="content" id="content" rows="10" 
                            class="block mt-1 w-full border-gray-300 focus:border-cielo-terracotta focus:ring-cielo-terracotta rounded-md shadow-sm" 
                            required>{{ old('content') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Dica: Você pode usar Markdown simples aqui (# Titulo, **negrito**) ou HTML básico.</p>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    {{-- Opções Extras --}}
                    <div class="flex flex-col sm:flex-row gap-6 border-t border-gray-100 pt-6">
                        {{-- Destaque --}}
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-cielo-terracotta shadow-sm focus:ring-cielo-terracotta">
                            <label for="is_featured" class="ml-2 text-sm text-gray-600">Destaque na Home</label>
                        </div>

                        {{-- Data --}}
                        <div class="flex-1">
                            <x-input-label for="published_at" :value="__('Data de Publicação')" />
                            <input type="date" name="published_at" id="published_at" 
                                value="{{ old('published_at', now()->format('Y-m-d')) }}"
                                class="mt-1 block w-full border-gray-300 focus:border-cielo-terracotta focus:ring-cielo-terracotta rounded-md shadow-sm">
                            <p class="text-xs text-gray-500 mt-1">Deixe em branco para salvar como rascunho.</p>
                        </div>
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="flex justify-end gap-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-100 rounded-md text-gray-600 hover:bg-gray-200 transition text-sm font-medium uppercase tracking-widest">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Publicar Artigo') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>