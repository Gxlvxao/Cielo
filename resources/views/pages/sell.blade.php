<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[60vh] min-h-[500px]">
        <img src="{{ asset('images/lisboa.jpg') }}" alt="Sell with Crow" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="absolute inset-0 flex items-center pt-20">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl animate-fade-in-up">
                    <span class="text-accent font-bold tracking-widest uppercase mb-4 block">{{ __('Exclusive Service') }}</span>
                    <h1 class="text-5xl md:text-7xl font-heading font-bold text-white mb-8 leading-tight">
                        {{ __('Sell with') }} <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">{{ __('Discretion & Impact') }}</span>
                    </h1>
                    <p class="text-xl text-gray-300 font-light max-w-2xl leading-relaxed border-l-4 border-accent pl-6">
                        {{ __('Connect your property with our exclusive network of international investors through our proven off-market strategy.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="py-24 bg-background">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-20">
                
                {{-- Coluna Esquerda: Benefícios --}}
                <div class="animate-fade-up space-y-12">
                    <div>
                        <h2 class="text-4xl font-heading font-bold mb-6">{{ __('Why choose Crow Global?') }}</h2>
                        <p class="text-lg text-muted-foreground">
                            {{ __('We understand that selling a premium asset requires more than just listing it online. It requires strategy, network, and discretion.') }}
                        </p>
                    </div>
                    
                    <div class="space-y-8">
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 group-hover:text-accent transition-colors">{{ __('Total Confidentiality') }}</h3>
                                <p class="text-muted-foreground leading-relaxed">{{ __('We protect your privacy. Your property is only presented to qualified investors with signed NDAs.') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 group-hover:text-accent transition-colors">{{ __('Qualified Network') }}</h3>
                                <p class="text-muted-foreground leading-relaxed">{{ __('Direct access to family offices, investment funds, and high-net-worth individuals actively looking for assets.') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 group-hover:text-accent transition-colors">{{ __('Verified Valuation') }}</h3>
                                <p class="text-muted-foreground leading-relaxed">{{ __('We provide a realistic market analysis to help define the correct value and maximize your return.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Coluna Direita: Formulário --}}
                <div class="relative animate-fade-up delay-100">
                    <div class="absolute -inset-1 bg-gradient-to-br from-accent to-accent/20 rounded-3xl blur opacity-30"></div>
                    <div class="relative bg-card p-8 md:p-10 rounded-3xl border border-white/10 shadow-2xl">
                        <h3 class="text-2xl font-bold mb-8 text-center">{{ __('Submit Your Property') }}</h3>
                        
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="first_name" :value="__('Name')" />
                                    <x-text-input id="first_name" class="block mt-2 w-full bg-background/50" type="text" name="first_name" required placeholder="John" />
                                </div>
                                <div>
                                    <x-input-label for="last_name" :value="__('Surname')" />
                                    <x-text-input id="last_name" class="block mt-2 w-full bg-background/50" type="text" name="last_name" required placeholder="Doe" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-2 w-full bg-background/50" type="email" name="email" required placeholder="john@example.com" />
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-2 w-full bg-background/50" type="text" name="phone" required placeholder="+351 ..." />
                                </div>
                                <div>
                                    <x-input-label for="property_type" :value="__('Type')" />
                                    <select id="property_type" name="property_type" class="block mt-2 w-full border-gray-700 bg-background/50 rounded-md shadow-sm focus:border-accent focus:ring-accent text-gray-300">
                                        <option value="apartment">{{ __('Apartment') }}</option>
                                        <option value="villa">{{ __('Villa') }}</option>
                                        <option value="land">{{ __('Land') }}</option>
                                        <option value="commercial">{{ __('Commercial') }}</option>
                                        <option value="hotel">{{ __('Hotel / Resort') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="location" :value="__('Location / City')" />
                                <x-text-input id="location" class="block mt-2 w-full bg-background/50" type="text" name="location" required placeholder="Ex: Cascais, Lisboa..." />
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Message / Details')" />
                                <textarea id="message" name="message" rows="4" class="block mt-2 w-full border-gray-700 bg-background/50 rounded-md shadow-sm focus:border-accent focus:ring-accent text-gray-300" placeholder="{{ __('Tell us a bit about the property...') }}"></textarea>
                            </div>

                            <div class="flex items-start gap-3">
                                <input type="checkbox" id="nda" name="nda" class="mt-1 rounded border-gray-600 bg-background text-accent focus:ring-accent">
                                <label for="nda" class="text-sm text-muted-foreground">{{ __('I would like to request a Non-Disclosure Agreement (NDA) before sharing sensitive details.') }}</label>
                            </div>

                            <button type="submit" class="w-full bg-accent hover:bg-white hover:text-accent text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-accent/25 transform hover:-translate-y-1">
                                {{ __('Submit Property for Review') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
</x-public-layout>