<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-heading font-semibold text-xl text-graphite leading-tight">
                {{ __('Jornal Cielo - Gestão de Conteúdo') }}
            </h2>
            
            {{-- CORRIGIDO: Usando style inline para garantir a cor DOURADA sem depender do build do CSS --}}
            <a href="{{ route('admin.posts.create') }}" 
               style="background-color: #C9A35E; color: white;"
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:opacity-80 transition ease-in-out duration-150 shadow-md">
                + Novo Artigo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Mensagem de Sucesso --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 shadow-sm flex justify-between items-center">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-green-500 hover:text-green-700">
                        <span class="sr-only">Fechar</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                
                {{-- Estado Vazio --}}
                @if($posts->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="bg-gray-50 rounded-full p-4 mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">O Jornal está vazio</h3>
                        <p class="text-gray-500 mt-1 max-w-sm">Comece a criar conteúdo de autoridade para atrair clientes.</p>
                        {{-- Link no estado vazio também corrigido --}}
                        <a href="{{ route('admin.posts.create') }}" style="color: #C9A35E;" class="mt-4 hover:underline font-medium">Criar primeiro artigo &rarr;</a>
                    </div>
                @else
                    {{-- Tabela de Dados --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Conteúdo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($posts as $post)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap w-24">
                                            @if($post->image_path)
                                                <img src="{{ asset('storage/' . $post->image_path) }}" class="h-12 w-16 object-cover rounded shadow-sm">
                                            @else
                                                <div class="h-12 w-16 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs shadow-inner">
                                                    Sem img
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900 line-clamp-1">{{ $post->title }}</div>
                                            <div class="text-xs text-gray-500 font-mono mt-0.5 truncate max-w-xs">/{{ $post->slug }}</div>
                                            @if($post->is_featured)
                                                <span style="color: #C9A35E; border-color: #C9A35E;" class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-yellow-50 mt-1 border border-opacity-30">
                                                    ★ Destaque Home
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                {{ ucfirst(str_replace('_', ' ', $post->category)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($post->published_at && $post->published_at <= now())
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                    Publicado {{ $post->published_at->format('d/m') }}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    Rascunho
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.posts.edit', $post) }}" style="color: #C9A35E;" class="font-semibold mr-4 hover:opacity-80 transition-colors">Editar</a>
                                            
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" onclick="return confirm('Tem certeza que deseja remover este artigo? Esta ação não pode ser desfeita.')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Paginação --}}
                    @if($posts->hasPages())
                        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>