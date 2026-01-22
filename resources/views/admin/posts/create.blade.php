<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-graphite leading-tight">
            {{ __('Novo Artigo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Título')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category" :value="__('Categoria')" />
                        <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-accent focus:ring-accent rounded-md shadow-sm">
                            <option value="arquitetura">Arquitetura</option>
                            <option value="estilo_vida">Estilo de Vida</option>
                            <option value="feng_shui">Feng Shui no Lar</option>
                            <option value="mercado_luxo">Mercado de Luxo</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Imagem de Capa')" />
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent/10 file:text-accent hover:file:bg-accent/20" required>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Conteúdo do Artigo')" />
                        <textarea name="content" id="content" rows="10" class="block mt-1 w-full border-gray-300 focus:border-accent focus:ring-accent rounded-md shadow-sm" required>{{ old('content') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Dica: Você pode usar Markdown simples aqui ou HTML básico.</p>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="flex gap-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" class="rounded border-gray-300 text-accent shadow-sm focus:ring-accent">
                            <label for="is_featured" class="ml-2 text-sm text-gray-600">Destaque na Home</label>
                        </div>

                        <div>
                            <x-input-label for="published_at" :value="__('Data de Publicação')" />
                            <input type="date" name="published_at" id="published_at" class="border-gray-300 focus:border-accent focus:ring-accent rounded-md shadow-sm">
                            <p class="text-xs text-gray-500">Deixe em branco para salvar como rascunho.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-300 rounded-md text-gray-700 hover:bg-gray-400 transition">Cancelar</a>
                        <x-primary-button>
                            {{ __('Publicar Artigo') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>