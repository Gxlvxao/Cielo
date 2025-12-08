<x-public-layout>
    @include('components.header')

    <main class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('home') }}" class="hover:text-accent">Home</a>
                    <span>/</span>
                    <a href="{{ route('properties.index') }}" class="hover:text-accent">Imóveis</a>
                    <span>/</span>
                    <span class="text-accent font-medium">{{ $property->city }}</span>
                </div>
                <h1 class="text-4xl font-heading font-bold text-graphite">{{ $property->title }}</h1>
                <p class="text-lg text-gray-600 flex items-center gap-2 mt-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $property->address }}, {{ $property->city }}
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8 shadow-sm" role="alert">
                    <strong class="font-bold">Sucesso!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="rounded-2xl overflow-hidden shadow-xl aspect-video relative group bg-gray-200">
                        @if($property->cover_image)
                            <img src="{{ Storage::url($property->cover_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @elseif($property->images && count($property->images) > 0)
                            <img src="{{ Storage::url($property->images[0]) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">Sem imagem</div>
                        @endif
                        
                        @if($property->is_exclusive)
                            <div class="absolute top-4 right-4 bg-accent text-white px-4 py-2 rounded-full font-bold shadow-lg text-sm tracking-wide">EXCLUSIVO</div>
                        @endif
                    </div>

                    @if($property->images && count($property->images) > 0)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($property->images as $image)
                                <a href="{{ Storage::url($image) }}" target="_blank" class="block aspect-square rounded-lg overflow-hidden shadow-sm hover:opacity-90 transition-opacity border border-gray-200">
                                    <img src="{{ Storage::url($image) }}" class="w-full h-full object-cover">
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <span class="block text-2xl font-bold text-graphite">{{ $property->bedrooms ?? '-' }}</span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Quartos</span>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <span class="block text-2xl font-bold text-graphite">{{ $property->bathrooms ?? '-' }}</span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Banheiros</span>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <span class="block text-2xl font-bold text-graphite">{{ $property->area ?? '-' }}m²</span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Área Útil</span>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <span class="block text-xl font-bold text-graphite truncate">{{ $property->price > 0 ? $property->formatted_price : 'Sob Consulta' }}</span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Valor</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-2xl font-heading font-bold text-graphite mb-4">Sobre este Imóvel</h3>
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            {!! nl2br(e($property->description)) !!}
                        </div>
                    </div>

                    @if($property->video_embed)
                        <div class="mt-12">
                            <h3 class="text-2xl font-heading font-bold text-graphite mb-6 flex items-center gap-3">
                                <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                Tour Virtual
                            </h3>
                            <div class="aspect-video rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-black">
                                <iframe 
                                    class="w-full h-full" 
                                    src="{{ $property->video_embed }}" 
                                    title="Video Player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-1" x-data="{ showModal: false }">
                    <div class="sticky top-24 bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                        <div class="text-center mb-6">
                            <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Investimento</p>
                            <p class="text-4xl font-bold text-graphite font-heading">{{ $property->price > 0 ? $property->formatted_price : 'Sob Consulta' }}</p>
                        </div>

                        <hr class="border-gray-100 my-6">

                        <div class="space-y-4">
                            @if($property->whatsapp_link)
                                <a href="{{ $property->whatsapp_link }}" target="_blank" class="flex items-center justify-center gap-3 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-green-200 transition-all transform hover:-translate-y-1">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    Conversar no WhatsApp
                                </a>
                            @endif

                            <button @click="showModal = true" class="w-full bg-graphite hover:bg-black text-white font-bold py-4 px-6 rounded-xl transition-all shadow-md flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Agendar Visita
                            </button>
                        </div>
                    </div>

                    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                        <div x-show="showModal" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 bg-black bg-opacity-60 transition-opacity" 
                             @click="showModal = false"></div>

                        <div x-show="showModal"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                            
                            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                            <h3 class="text-xl font-bold leading-6 text-graphite mb-2" id="modal-title">Agendar Visita</h3>
                                            <p class="text-sm text-gray-500 mb-6">Preencha seus dados para solicitar uma visita a este imóvel.</p>
                                            
                                            <form action="{{ route('properties.visit', $property) }}" method="POST">
                                                @csrf
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                                                        <input type="text" name="name" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent focus:ring-accent" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                                        <input type="email" name="email" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent focus:ring-accent" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Telefone / WhatsApp</label>
                                                        <input type="text" name="phone" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent focus:ring-accent" placeholder="+351...">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Data Preferencial</label>
                                                        <input type="text" name="preferred_date" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent focus:ring-accent" placeholder="Ex: Próxima terça à tarde">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Mensagem (Opcional)</label>
                                                        <textarea name="message" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent focus:ring-accent"></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex flex-row-reverse gap-2">
                                                    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-accent px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent/90 sm:w-auto">Enviar Solicitação</button>
                                                    <button type="button" @click="showModal = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</x-public-layout>