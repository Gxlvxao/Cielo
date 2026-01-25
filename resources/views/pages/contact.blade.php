<x-site-layout>

    {{-- 1. HERO HEADER --}}
    <div class="relative w-full h-[60vh] min-h-[500px] bg-cielo-dark overflow-hidden">
        {{-- Imagem Feng Shui / Zen / Arquitetura Minimalista --}}
        <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=2000&auto=format&fit=crop" 
             alt="Contact Cielo" 
             class="absolute inset-0 w-full h-full object-cover opacity-90 grayscale-[10%] mix-blend-overlay scale-105 animate-slow-zoom">
        
        {{-- Gradiente suavizado --}}
        <div class="absolute inset-0 bg-gradient-to-b from-cielo-dark/40 via-transparent to-cielo-dark/60"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 z-10">
            <h1 class="font-serif text-4xl md:text-6xl text-white mb-6 max-w-4xl leading-tight drop-shadow-lg">
                {{ __('contact.hero_title') }}
            </h1>
            <p class="font-inter font-light text-lg md:text-xl text-white/90 max-w-2xl drop-shadow-md">
                {{ __('contact.hero_subtitle') }}
            </p>
        </div>
    </div>

    {{-- 2. CONTEÚDO PRINCIPAL --}}
    <section class="py-24 px-6 bg-cielo-cream/30">
        <div class="max-w-[90rem] mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">
                
                {{-- COLUNA ESQUERDA: Infos Oficiais & Mapa --}}
                <div class="lg:col-span-5 space-y-20 pt-8">
                    
                    {{-- Dados de Contato --}}
                    <div class="space-y-12">
                        
                        {{-- Phone --}}
                        <div class="group cursor-default">
                            <div class="flex items-center gap-3 mb-3 text-cielo-navy/40 group-hover:text-cielo-terracotta transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <p class="text-xs font-bold uppercase tracking-widest">Phone</p>
                            </div>
                            <p class="font-serif text-3xl text-cielo-dark leading-snug group-hover:translate-x-2 transition-transform duration-500 ease-out">
                                +351 920 383 259
                            </p>
                        </div>
                        
                        {{-- Email --}}
                        <div class="group cursor-pointer" onclick="window.location.href='mailto:info@cielo.pt'">
                            <div class="flex items-center gap-3 mb-3 text-cielo-navy/40 group-hover:text-cielo-terracotta transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <p class="text-xs font-bold uppercase tracking-widest">E-Mail</p>
                            </div>
                            <a href="mailto:info@cielo.pt" class="font-serif text-3xl text-cielo-dark leading-snug block group-hover:translate-x-2 transition-transform duration-500 ease-out">
                                info@cielo.pt
                            </a>
                        </div>

                        {{-- Location (Atualizado) --}}
                        <div class="group cursor-default">
                            <div class="flex items-center gap-3 mb-3 text-cielo-navy/40 group-hover:text-cielo-terracotta transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-xs font-bold uppercase tracking-widest">Location</p>
                            </div>
                            <p class="font-serif text-3xl text-cielo-dark leading-snug group-hover:translate-x-2 transition-transform duration-500 ease-out">
                                Avenida da Liberdade 245 - 4A,<br>
                                1250-143 Lisboa
                            </p>
                        </div>
                    </div>

                    {{-- Redes Sociais --}}
                    <div class="flex gap-6 pl-1">
                        <a href="https://www.instagram.com/casablanca.pt/" target="_blank" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-cielo-dark hover:bg-cielo-dark hover:text-white transition-all duration-300 hover:scale-110 hover:shadow-lg">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/casablancaproperty" target="_blank" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-cielo-dark hover:bg-cielo-dark hover:text-white transition-all duration-300 hover:scale-110 hover:shadow-lg">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-cielo-dark hover:bg-cielo-dark hover:text-white transition-all duration-300 hover:scale-110 hover:shadow-lg">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>

                    {{-- Mapa (Av. da Liberdade) --}}
                    <div class="w-full h-80 bg-gray-100 rounded-2xl overflow-hidden shadow-lg border border-white/50 grayscale hover:grayscale-0 transition-all duration-1000 ease-in-out">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3112.772592534571!2d-9.150493624233777!3d38.72297127176189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd193379b3806a5b%3A0x8e83344383c38f2!2sAv.%20da%20Liberdade%20245%2C%201250-142%20Lisboa!5e0!3m2!1spt-PT!2spt!4v1709225000000!5m2!1spt-PT!2spt" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>

                </div>

                {{-- COLUNA DIREITA: Formulário --}}
                <div class="lg:col-span-7 bg-white p-8 md:p-12 border border-gray-100 rounded-[2rem] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] relative z-10">
                    
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-green-50 text-green-800 border border-green-200 text-sm rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <div class="space-y-1 group">
                            <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.name') }}</label>
                            <input type="text" name="name" placeholder="{{ __('contact.form.name_placeholder') }}" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all placeholder-gray-300 text-cielo-dark">
                        </div>

                        <div class="space-y-1 group">
                            <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.email') }}</label>
                            <input type="email" name="email" placeholder="{{ __('contact.form.email_placeholder') }}" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all placeholder-gray-300 text-cielo-dark">
                        </div>

                        <div class="space-y-1 group">
                            <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.phone') }}</label>
                            <input type="text" name="phone" placeholder="{{ __('contact.form.phone_placeholder') }}" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all placeholder-gray-300 text-cielo-dark">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1 group">
                                <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.location') }}</label>
                                <input type="text" name="location" placeholder="{{ __('contact.form.location_placeholder') }}" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all placeholder-gray-300 text-cielo-dark">
                            </div>

                            <div class="space-y-1 group">
                                <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.typology') }}</label>
                                <input type="text" name="typology" placeholder="Ex: T2, T3, Villa" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all placeholder-gray-300 text-cielo-dark">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1 group">
                                <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.goal') }}</label>
                                <select name="goal" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all text-cielo-dark cursor-pointer">
                                    <option value="" disabled selected class="text-gray-300">Selecione uma opção</option>
                                    @foreach(__('contact.form.goal_options') as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1 group">
                                <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50 group-focus-within:text-cielo-terracotta transition-colors">{{ __('contact.form.timeline') }}</label>
                                <select name="timeline" class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-3 focus:ring-0 focus:border-cielo-terracotta transition-all text-cielo-dark cursor-pointer">
                                    <option value="" disabled selected class="text-gray-300">Selecione o prazo</option>
                                    @foreach(__('contact.form.timeline_options') as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-4 pt-4">
                            <label class="text-xs font-bold uppercase tracking-widest text-cielo-navy/50">{{ __('contact.form.sell_to_buy') }}</label>
                            <div class="flex gap-8">
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="sell_to_buy" value="yes" class="form-radio text-cielo-terracotta border-gray-300 focus:ring-cielo-terracotta transition-all">
                                    <span class="ml-3 text-cielo-dark group-hover:text-cielo-terracotta transition-colors">{{ __('contact.form.yes') }}</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="sell_to_buy" value="no" class="form-radio text-cielo-terracotta border-gray-300 focus:ring-cielo-terracotta transition-all">
                                    <span class="ml-3 text-cielo-dark group-hover:text-cielo-terracotta transition-colors">{{ __('contact.form.no') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4">
                            <label class="inline-flex items-start cursor-pointer group">
                                <input type="checkbox" name="privacy" required class="mt-1 form-checkbox text-cielo-terracotta border-gray-300 focus:ring-cielo-terracotta rounded-sm transition-all">
                                <span class="ml-3 text-sm text-cielo-navy/60 group-hover:text-cielo-dark transition-colors leading-relaxed">
                                    {{ __('contact.form.privacy') }}
                                </span>
                            </label>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full md:w-auto px-16 bg-cielo-dark text-white h-16 flex items-center justify-center text-xs font-bold uppercase tracking-widest hover:bg-cielo-terracotta transition-all duration-500 ease-out shadow-md hover:shadow-lg rounded-full">
                                {{ __('contact.form.submit') }}
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>

    <x-cielo.footer-big />

</x-site-layout>