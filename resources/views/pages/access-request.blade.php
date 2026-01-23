<x-site-layout>
    <x-slot name="title">{{ __('access.meta_title') }}</x-slot>

    <div class="min-h-screen flex flex-col lg:flex-row">
        
        {{-- COLUNA ESQUERDA: Imagem / Branding --}}
        <div class="hidden lg:block w-1/2 relative overflow-hidden bg-cielo-dark h-screen sticky top-0">
            <img src="{{ asset('images/hero-luxury.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Luxury Texture">
            <div class="absolute inset-0 bg-gradient-to-t from-cielo-dark via-transparent to-transparent"></div>
            
            <div class="absolute bottom-20 left-20 max-w-lg text-white">
                <h2 class="font-serif text-5xl mb-6">{{ __('access.hero_title') }}</h2>
                <p class="font-light text-lg opacity-80 leading-relaxed">
                    {{ __('access.hero_subtitle') }}
                </p>
                
                <div class="mt-12 flex gap-8">
                    <div>
                        <span class="block text-2xl font-serif">500+</span>
                        <span class="text-xs uppercase tracking-widest opacity-60">{{ __('access.stats_investors') }}</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-serif">€120M</span>
                        <span class="text-xs uppercase tracking-widest opacity-60">{{ __('access.stats_portfolio') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUNA DIREITA: Formulário --}}
        <div class="w-full lg:w-1/2 bg-cielo-cream flex items-center justify-center p-8 md:p-16 lg:p-24 relative min-h-screen">
            
            {{-- Back Button (Mobile) --}}
            <a href="{{ route('home') }}" class="absolute top-8 right-8 text-xs font-bold uppercase tracking-widest text-cielo-dark/50 hover:text-cielo-terracotta transition-colors">
                {{ __('access.back') }}
            </a>

            {{-- Inicializa com 'client' para bater com o enum do controller --}}
            <div class="w-full max-w-md" x-data="{ investor_type: 'client' }">
                
                {{-- Header do Form --}}
                <div class="mb-10">
                    <span class="text-cielo-terracotta text-xs font-bold tracking-[0.2em] uppercase block mb-3">{{ __('access.form_eyebrow') }}</span>
                    <h1 class="font-serif text-4xl text-cielo-dark">{{ __('access.form_title') }}</h1>
                </div>

                {{-- Feedback de Sucesso --}}
                @if(session('success'))
                    <div class="mb-8 p-6 bg-green-50 border border-green-100 rounded-xl text-green-800 text-sm">
                        <svg class="w-6 h-6 mb-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <p class="font-bold mb-1">{{ __('access.success_title') }}</p>
                        <p>{{ __('access.success_message') }}</p>
                        <a href="{{ route('home') }}" class="inline-block mt-4 text-green-700 underline font-bold text-xs uppercase tracking-wider">{{ __('access.back_home') }}</a>
                    </div>
                @else

                    {{-- Seletor de Perfil (Toggle) --}}
                    {{-- Mapeia para 'client' ou 'developer' --}}
                    <div class="flex p-1 bg-white border border-gray-200 rounded-xl mb-8 relative">
                        <div class="w-1/2 h-full absolute top-0 left-0 bg-cielo-dark rounded-lg transition-transform duration-300 ease-out"
                             :class="investor_type === 'client' ? 'translate-x-1 translate-y-1 w-[calc(50%-4px)] h-[calc(100%-8px)]' : 'translate-x-[100%] translate-y-1 w-[calc(50%-4px)] h-[calc(100%-8px)]'"></div>
                        
                        <button @click="investor_type = 'client'" 
                                class="flex-1 py-3 text-xs font-bold uppercase tracking-widest relative z-10 transition-colors text-center"
                                :class="investor_type === 'client' ? 'text-white' : 'text-gray-400 hover:text-gray-600'">
                            {{ __('access.role_investor') }}
                        </button>
                        <button @click="investor_type = 'developer'" 
                                class="flex-1 py-3 text-xs font-bold uppercase tracking-widest relative z-10 transition-colors text-center"
                                :class="investor_type === 'developer' ? 'text-white' : 'text-gray-400 hover:text-gray-600'">
                            {{ __('access.role_developer') }}
                        </button>
                    </div>

                    {{-- FORMULÁRIO --}}
                    {{-- Adicionado enctype="multipart/form-data" para upload de arquivos --}}
                    <form method="POST" action="{{ route('access-request.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Campo Oculto (Mapeado para o BD) --}}
                        <input type="hidden" name="investor_type" x-model="investor_type">

                        {{-- Nome --}}
                        <div>
                            <x-input-label for="name" :value="__('access.label_name')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                            <x-text-input id="name" class="block mt-1 w-full bg-white border-gray-200 focus:border-cielo-terracotta focus:ring-cielo-terracotta py-3" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" :value="__('access.label_email')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                            <x-text-input id="email" class="block mt-1 w-full bg-white border-gray-200 focus:border-cielo-terracotta focus:ring-cielo-terracotta py-3" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- País (Obrigatório no Controller) --}}
                            <div>
                                <x-input-label for="country" :value="__('access.label_country')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                                <x-text-input id="country" class="block mt-1 w-full bg-white border-gray-200 py-3" type="text" name="country" :value="old('country')" required />
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>

                            {{-- Telefone --}}
                            <div>
                                <x-input-label for="phone" :value="__('access.label_phone')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                                <x-text-input id="phone" class="block mt-1 w-full bg-white border-gray-200 py-3" type="text" name="phone" :value="old('phone')" />
                            </div>
                        </div>

                        {{-- Montante de Investimento (Opcional) --}}
                        <div x-show="investor_type === 'client'" x-transition>
                            <x-input-label for="investment_amount" :value="__('access.label_investment')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                            <select name="investment_amount" id="investment_amount" class="block mt-1 w-full bg-white border-gray-200 rounded-md shadow-sm focus:border-cielo-terracotta focus:ring focus:ring-cielo-terracotta focus:ring-opacity-50 py-3 text-sm">
                                <option value="">{{ __('access.select_placeholder') }}</option>
                                <option value="< 500k">{{ __('access.investment_upto_500k') }}</option>
                                <option value="500k - 1M">{{ __('access.investment_500k_1m') }}</option>
                                <option value="1M - 3M">{{ __('access.investment_1m_3m') }}</option>
                                <option value="> 3M">{{ __('access.investment_plus_3m') }}</option>
                            </select>
                        </div>

                        {{-- Upload de Documento (Proof of Funds / Portfolio) --}}
                        <div>
                            <x-input-label for="proof_document" :value="__('access.label_document')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                            <input type="file" name="proof_document" id="proof_document" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-xs file:font-semibold
                                file:bg-cielo-terracotta/10 file:text-cielo-terracotta
                                hover:file:bg-cielo-terracotta/20 mt-2
                            "/>
                            <p class="text-[10px] text-gray-400 mt-1">{{ __('access.document_help') }}</p>
                            <x-input-error :messages="$errors->get('proof_document')" class="mt-2" />
                        </div>

                        {{-- Mensagem --}}
                        <div>
                            <x-input-label for="message" :value="__('access.label_message')" class="uppercase text-[10px] tracking-widest text-gray-400" />
                            <textarea id="message" name="message" rows="3" 
                                class="block mt-1 w-full border-gray-200 focus:border-cielo-terracotta focus:ring-cielo-terracotta rounded-md shadow-sm resize-none text-sm font-sans"
                                placeholder="{{ __('access.message_placeholder') }}"></textarea>
                        </div>

                        {{-- Consentimento (Obrigatório) --}}
                        <div class="flex items-start">
                            <input type="checkbox" name="consent" id="consent" required class="mt-1 rounded border-gray-300 text-cielo-terracotta focus:ring-cielo-terracotta">
                            <label for="consent" class="ml-2 text-xs text-gray-500 leading-relaxed">
                                {{ __('access.consent_text') }} <a href="{{ route('legal.privacy') }}" class="underline hover:text-cielo-dark">{{ __('access.privacy_policy') }}</a>.
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('consent')" class="mt-2" />

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-cielo-dark text-white py-4 rounded-lg font-bold uppercase tracking-[0.15em] text-xs hover:bg-cielo-terracotta transition-all duration-500 shadow-lg hover:shadow-xl">
                                {{ __('access.submit_btn') }}
                            </button>
                        </div>

                        <p class="text-center text-[10px] text-gray-400 uppercase tracking-widest mt-6">
                            {{ __('access.already_member') }} <a href="{{ route('login') }}" class="text-cielo-terracotta hover:underline font-bold">{{ __('access.login') }}</a>
                        </p>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-site-layout>