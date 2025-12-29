<x-public-layout>
    @include('components.header')
    
    <main>
        <div class="relative w-full h-screen">
            <img src="{{ asset('images/hero-luxury.jpg') }}" alt="Luxury" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80"></div>
            
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
                
                {{-- MOLDURA REDONDA PARA O LOGO DO CLIENTE --}}
                <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto bg-white/10 backdrop-blur-sm rounded-full p-3 border-4 border-accent shadow-2xl overflow-hidden mb-6 animate-fade-in-up">
                    <img src="{{ asset('images/client-logo.png') }}" alt="Logo do Cliente" class="w-full h-full object-contain rounded-full">
                </div>

                <h1 class="font-heading text-5xl md:text-7xl font-bold mb-4 animate-fade-in-up">
                    <span class="text-white">CROW</span>
                    <span class="text-accent">GLOBAL</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 font-light tracking-wide max-w-2xl mx-auto animate-fade-in-up delay-100 text-gray-200">
                    {{ __('Premium Real Estate Investments in Portugal') }}
                </p>
                
                <div class="w-full max-w-4xl animate-fade-in-up delay-200">
                    <form action="{{ route('properties.index') }}" method="GET" class="bg-white/10 backdrop-blur-xl border border-white/20 p-2 rounded-full flex flex-col md:flex-row gap-2 shadow-2xl">
                        
                        {{-- SELECT CIDADE --}}
                        <div class="flex-1 relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-300 group-focus-within:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <select name="city" class="block w-full pl-12 pr-10 py-3 bg-transparent border-none text-white placeholder-gray-300 focus:ring-0 focus:bg-white/5 rounded-full transition-colors cursor-pointer appearance-none text-sm font-medium">
                                <option value="" class="text-gray-900">{{ __('City') }} ({{ __('All') }})</option>
                                <option value="Lisboa" class="text-gray-900">Lisboa</option>
                                <option value="Porto" class="text-gray-900">Porto</option>
                                <option value="Cascais" class="text-gray-900">Cascais</option>
                                <option value="Faro" class="text-gray-900">Faro</option>
                                <option value="Braga" class="text-gray-900">Braga</option>
                                <option value="Coimbra" class="text-gray-900">Coimbra</option>
                            </select>
                        </div>

                        <div class="w-px bg-white/20 my-2 hidden md:block"></div>

                        {{-- SELECT TIPO DE IMÓVEL --}}
                        <div class="flex-1 relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-300 group-focus-within:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <select name="type" class="block w-full pl-12 pr-10 py-3 bg-transparent border-none text-white placeholder-gray-300 focus:ring-0 focus:bg-white/5 rounded-full transition-colors cursor-pointer appearance-none text-sm font-medium">
                                <option value="" class="text-gray-900">{{ __('Property Type') }} ({{ __('All') }})</option>
                                {{-- AQUI ESTAVA O PROBLEMA: Agora traduzimos os nomes --}}
                                <option value="apartment" class="text-gray-900">{{ __('Apartment') }}</option>
                                <option value="house" class="text-gray-900">{{ __('House') }}</option>
                                <option value="villa" class="text-gray-900">{{ __('Villa') }}</option>
                                <option value="land" class="text-gray-900">{{ __('Land') }}</option>
                                <option value="commercial" class="text-gray-900">{{ __('Commercial') }}</option>
                            </select>
                        </div>

                        <div class="w-px bg-white/20 my-2 hidden md:block"></div>

                        {{-- SELECT TRANSAÇÃO --}}
                        <div class="flex-1 relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-300 group-focus-within:text-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <select name="transaction_type" class="block w-full pl-12 pr-10 py-3 bg-transparent border-none text-white placeholder-gray-300 focus:ring-0 focus:bg-white/5 rounded-full transition-colors cursor-pointer appearance-none text-sm font-medium">
                                <option value="" class="text-gray-900">{{ __('Transaction') }}</option>
                                {{-- AQUI TAMBÉM: Traduzindo Buy e Rent --}}
                                <option value="sale" class="text-gray-900">{{ __('Buy') }}</option>
                                <option value="rent" class="text-gray-900">{{ __('Rent') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-accent hover:bg-white hover:text-accent text-white font-bold py-3 px-8 rounded-full transition-all shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span>{{ __('Explore Properties') }}</span>
                        </button>
                    </form>
                </div>

                <div class="mt-8 animate-fade-in-up delay-300">
                    <a href="{{ route('register') }}" class="text-sm font-medium text-gray-300 hover:text-white border-b border-transparent hover:border-white transition-all pb-1">
                        {{ __('Request Access') }} &rarr;
                    </a>
                </div>
            </div>
        </div>
        
        <div id="about">
            @include('components.about')
        </div>

        @include('components.municipalities')

        <div id="services">
            @include('components.services')
        </div>
        
        @include('components.off-market-cta')
    </main>
    
    @include('components.footer')
</x-public-layout>