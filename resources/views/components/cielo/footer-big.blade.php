<footer class="relative min-h-screen flex flex-col justify-between text-white bg-cielo-dark overflow-hidden">
    
    {{-- Imagem de Fundo --}}
    <div class="absolute inset-0 z-0">
        <img src="/images/footer.jpg" 
             class="w-full h-full object-cover opacity-50 mix-blend-overlay" 
             alt="Cielo Footer">
        <div class="absolute inset-0 bg-gradient-to-t from-cielo-dark via-cielo-dark/80 to-black/40"></div>
    </div>

    {{-- CONTEÚDO PRINCIPAL (CTA) --}}
    <div class="flex-grow flex items-center justify-center relative z-10 px-6 pt-20 pb-10">
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="font-serif text-5xl md:text-7xl lg:text-8xl leading-[1.1] mb-8 drop-shadow-2xl">
                {!! __('footer.title') !!}
            </h2>
            
            <p class="font-sans text-xl md:text-2xl font-light opacity-90 mb-12 max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                {{ __('footer.text') }}
            </p>
            
            <a href="{{ route('pages.contact') }}" class="group relative inline-flex items-center justify-center overflow-hidden bg-white text-cielo-dark px-12 py-5 rounded-full min-w-[240px] shadow-xl hover:shadow-2xl transition-all duration-300">
                <span class="font-bold text-sm uppercase tracking-[0.2em] transition-transform duration-500 ease-in-out group-hover:-translate-y-[150%]">
                    {{ __('footer.cta') }}
                </span>
                <span class="absolute font-bold text-sm uppercase tracking-[0.2em] transition-transform duration-500 ease-in-out translate-y-[150%] group-hover:translate-y-0 text-cielo-terracotta">
                    {{ __('footer.cta') }}
                </span>
            </a>
        </div>
    </div>

    {{-- SEÇÃO LEGAL & DADOS (Obrigatório Lei) --}}
    <div class="relative z-10 bg-black/40 backdrop-blur-md border-t border-white/10">
        <div class="max-w-[95rem] mx-auto px-6 py-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12 text-sm">
                
                {{-- Coluna 1: Marca & Licença --}}
                <div class="space-y-6">
                    <span class="font-serif text-3xl font-bold text-white tracking-widest block">Cielo</span>
                    <div class="text-white/60 space-y-2">
                        <p class="uppercase tracking-wider text-xs font-bold text-white/80">Licença & Registo</p>
                        <p>AMI: 12345 (Crow Global)</p>
                        <p>NIF: 500 000 000</p>
                    </div>
                    {{-- Socials --}}
                    <div class="flex gap-4">
                        <a href="#" class="text-white/60 hover:text-white transition-colors"><span class="sr-only">Instagram</span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                        <a href="#" class="text-white/60 hover:text-white transition-colors"><span class="sr-only">LinkedIn</span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                    </div>
                </div>

                {{-- Coluna 2: Contactos --}}
                <div class="space-y-4 text-white/60">
                    <p class="uppercase tracking-wider text-xs font-bold text-white/80">{{ __('footer.contacts_title') }}</p>
                    <p>Av. da Liberdade, 100, Lisboa</p>
                    <p>+351 912 345 678</p>
                    <p>hello@cielo.com</p>
                    <p class="text-xs pt-2">{{ __('footer.schedule') }}</p>
                </div>

                {{-- Coluna 3: Links Legais --}}
                <div class="space-y-4 text-white/60 flex flex-col">
                    <p class="uppercase tracking-wider text-xs font-bold text-white/80">{{ __('footer.legal_title') }}</p>
                    <a href="{{ route('legal.privacy') }}" class="hover:text-white hover:translate-x-1 transition-transform">{{ __('footer.privacy') }}</a>
                    <a href="{{ route('legal.terms') }}" class="hover:text-white hover:translate-x-1 transition-transform">{{ __('footer.terms') }}</a>
                    <a href="{{ route('legal.cookies') }}" class="hover:text-white hover:translate-x-1 transition-transform">{{ __('footer.cookies') }}</a>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-transform">{{ __('footer.ral') }}</a>
                </div>

                {{-- Coluna 4: Livro de Reclamações (Obrigatório) --}}
                <div class="flex flex-col items-start gap-4">
                    <a href="https://www.livroreclamacoes.pt" target="_blank" class="opacity-80 hover:opacity-100 transition-opacity bg-white p-2 rounded">
                        {{-- Use a imagem oficial se tiver, senão texto --}}
                        <img src="https://www.livroreclamacoes.pt/assets/images/livro_reclamacoes_pt.png" alt="Livro de Reclamações" class="h-10 w-auto">
                    </a>
                    <p class="text-[10px] text-white/40 leading-tight">
                        Em caso de litígio o consumidor pode recorrer a uma Entidade de Resolução Alternativa de Litígios de Consumo.
                    </p>
                </div>

            </div>

            {{-- Footer Bottom --}}
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest text-white/40">
                <p>© {{ date('Y') }} Cielo Real Estate. All rights reserved.</p>
                
                <div class="flex items-center gap-3 hover:text-white/80 transition-colors">
                    <span>{{ __('footer.developed') }}</span>
                    <img src="/images/maxsell.png" alt="MaxSell" class="h-4 w-auto brightness-0 invert">
                </div>
            </div>

        </div>
    </div>
</footer>