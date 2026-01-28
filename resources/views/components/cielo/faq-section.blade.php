<section class="bg-white py-20 lg:py-28 relative z-20 border-t border-gray-100">
    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-start">
            
            {{-- COLUNA ESQUERDA: TÍTULO STICKY --}}
            <div class="lg:col-span-4 lg:sticky lg:top-32 mb-12 lg:mb-0">
                <span class="font-sans text-xs font-bold tracking-[0.2em] uppercase text-cielo-terracotta mb-4 block">
                    Suporte
                </span>
                
                {{-- Fonte reduzida para manter a elegância (Quiet Luxury) --}}
                <h2 class="font-display text-4xl md:text-5xl text-cielo-dark leading-[0.95] mb-6">
                    {!! __('home.faq.title') ?? 'Dúvidas<br>Frequentes' !!}
                </h2>
                
                <p class="font-sans text-sm text-gray-400 leading-relaxed max-w-xs">
                    Não encontrou o que procura? <br>
                    {{-- CORREÇÃO DA ROTA AQUI: De 'contact' para 'pages.contact' --}}
                    <a href="{{ route('pages.contact') }}" class="text-cielo-dark underline hover:text-cielo-terracotta transition-colors">Entre em contato</a> com nossa equipe.
                </p>
            </div>

            {{-- COLUNA DIREITA: ACORDEÃO (Alpine.js) --}}
            <div class="lg:col-span-8 w-full" x-data="{ activeAccordion: null }">
                <div class="border-t border-gray-100">
                    
                    @foreach(range(1, 10) as $i)
                        <div class="group border-b border-gray-100">
                            
                            {{-- BOTÃO DA PERGUNTA --}}
                            <button 
                                @click="activeAccordion = (activeAccordion === {{ $i }} ? null : {{ $i }})"
                                class="w-full flex justify-between items-center text-left py-6 group focus:outline-none select-none"
                            >
                                {{-- Pergunta com fonte Display controlada (text-xl a 2xl) --}}
                                <h3 
                                    class="font-display text-xl md:text-2xl text-cielo-dark transition-colors duration-300 pr-8"
                                    :class="activeAccordion === {{ $i }} ? 'text-cielo-terracotta' : 'group-hover:text-cielo-terracotta'"
                                >
                                    {{ __("home.faq.q$i") }}
                                </h3>
                                
                                {{-- Ícone Animado --}}
                                <div class="relative flex-none w-6 h-6 flex items-center justify-center">
                                    {{-- Linha Vertical (Gira para sumir) --}}
                                    <span 
                                        class="absolute bg-cielo-dark w-[1px] h-full transition-transform duration-300 ease-out origin-center"
                                        :class="activeAccordion === {{ $i }} ? 'rotate-90 opacity-0' : 'rotate-0'"
                                    ></span>
                                    {{-- Linha Horizontal --}}
                                    <span class="absolute bg-cielo-dark w-full h-[1px]"></span>
                                </div>
                            </button>
                            
                            {{-- RESPOSTA (Alpine Collapse) --}}
                            <div 
                                x-show="activeAccordion === {{ $i }}" 
                                x-collapse 
                                x-cloak
                            >
                                <div class="pb-8 pr-4 md:pr-12">
                                    <p class="font-sans text-gray-500 font-light text-base md:text-lg leading-relaxed">
                                        {{ __("home.faq.a$i") }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>