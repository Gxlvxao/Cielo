<x-public-layout>
    {{-- MENU GLOBAL --}}
    @include('components.header')

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[50vh] min-h-[400px]">
        <img src="{{ asset('images/lisboa.jpg') }}" alt="Contact Crow Global" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-background"></div>
        <div class="absolute inset-0 flex items-center justify-center pt-20">
            <div class="text-center animate-fade-in-up">
                <span class="text-accent font-bold tracking-widest uppercase text-sm mb-4 block">{{ __('Get in Touch') }}</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold text-white">
                    {{ __('Contact Us') }}
                </h1>
            </div>
        </div>
    </div>

    {{-- CONTEÚDO PRINCIPAL --}}
    <section class="py-24 bg-background relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-accent/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-accent/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">
                
                {{-- Coluna Esquerda: Informações --}}
                <div class="animate-fade-up space-y-12">
                    <div>
                        <h2 class="text-3xl font-heading font-bold mb-6">{{ __('We are here to help') }}</h2>
                        <p class="text-lg text-muted-foreground leading-relaxed">
                            {{ __('Whether you represent a family office, an investment fund, or are looking for your next premium asset in Portugal, our team is ready to provide expert guidance.') }}
                        </p>
                    </div>

                    <div class="space-y-8">
                        {{-- Card: Office --}}
                        <div class="flex items-start gap-6 p-6 rounded-2xl bg-card border border-white/5 hover:border-accent/30 transition-colors group">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-6 h-6 text-accent group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">{{ __('Headquarters') }}</h3>
                                <p class="text-muted-foreground">Avenida da Liberdade, 110<br>1250-146 Lisboa, Portugal</p>
                            </div>
                        </div>

                        {{-- Card: Contacts --}}
                        <div class="flex items-start gap-6 p-6 rounded-2xl bg-card border border-white/5 hover:border-accent/30 transition-colors group">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-6 h-6 text-accent group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">{{ __('Direct Contacts') }}</h3>
                                <p class="text-muted-foreground mb-1"><a href="mailto:info@crow-global.com" class="hover:text-accent transition-colors">info@crow-global.com</a></p>
                                <p class="text-muted-foreground"><a href="tel:+351210000000" class="hover:text-accent transition-colors">+351 210 000 000</a></p>
                            </div>
                        </div>

                        {{-- Card: Schedule --}}
                        <div class="flex items-start gap-6 p-6 rounded-2xl bg-card border border-white/5 hover:border-accent/30 transition-colors group">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                <svg class="w-6 h-6 text-accent group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">{{ __('Opening Hours') }}</h3>
                                <p class="text-muted-foreground">{{ __('Mon - Fri') }}: 09:00 - 18:00<br>{{ __('Weekend') }}: {{ __('By appointment only') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Coluna Direita: Formulário --}}
                <div class="animate-fade-up delay-100">
                    <div class="bg-card p-8 md:p-10 rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden">
                        {{-- Decorative gradient top --}}
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-accent via-accent/50 to-transparent"></div>
                        
                        <h3 class="text-2xl font-bold mb-6">{{ __('Send us a message') }}</h3>
                        
                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" class="block mt-2 w-full bg-background/50" type="text" name="name" required placeholder="Ex: John Doe" />
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-2 w-full bg-background/50" type="email" name="email" required placeholder="john@example.com" />
                                </div>
                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-2 w-full bg-background/50" type="text" name="phone" required placeholder="+351..." />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="subject" :value="__('Subject')" />
                                <select id="subject" name="subject" class="block mt-2 w-full border-gray-700 bg-background/50 rounded-md shadow-sm focus:border-accent focus:ring-accent text-gray-300 h-11">
                                    <option value="general">{{ __('General Inquiry') }}</option>
                                    <option value="investment">{{ __('Investment Opportunities') }}</option>
                                    <option value="partnership">{{ __('Partnerships') }}</option>
                                    <option value="other">{{ __('Other') }}</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Message')" />
                                <textarea id="message" name="message" rows="4" class="block mt-2 w-full border-gray-700 bg-background/50 rounded-md shadow-sm focus:border-accent focus:ring-accent text-gray-300" required placeholder="{{ __('How can we help you?') }}"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-white text-gray-900 hover:bg-accent hover:text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                                {{ __('Send Message') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAP SECTION (Opcional, mas dá um toque pro) --}}
    <section class="h-[400px] w-full bg-gray-200 relative grayscale hover:grayscale-0 transition-all duration-700">
        {{-- Placeholder para iframe do Google Maps --}}
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3113.577963479032!2d-9.14867922416562!3d38.71694935824971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19337e3df5005b%3A0x23f790290e292025!2sAv.%20da%20Liberdade%20110%2C%201250-146%20Lisboa!5e0!3m2!1spt-PT!2spt!4v1709825432123!5m2!1spt-PT!2spt" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        
        {{-- Overlay para não ficar muito "Google Maps" cru --}}
        <div class="absolute inset-0 bg-accent/10 pointer-events-none"></div>
    </section>

    @include('components.footer')
</x-public-layout>