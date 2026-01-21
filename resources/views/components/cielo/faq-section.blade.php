<section class="bg-white py-32 px-6 relative z-20 border-t border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <div class="lg:col-span-4 sticky top-32">
                <h2 class="font-serif text-4xl md:text-6xl text-cielo-dark leading-tight">
                    {!! __('home.faq.title') !!}
                </h2>
                <div class="w-12 h-1 bg-cielo-terracotta mt-8"></div>
            </div>

            <div class="lg:col-span-8 space-y-0">
                
                @foreach(range(1, 10) as $i)
                    <div class="border-b border-cielo-dark/10">
                        
                        <button onclick="toggleCieloFaq({{ $i }})" 
                                class="w-full flex justify-between items-start text-left py-8 group focus:outline-none">
                            
                            <h3 class="font-serif text-xl md:text-2xl text-cielo-dark group-hover:text-cielo-terracotta transition-colors duration-300 pr-8">
                                {{ __("home.faq.q$i") }}
                            </h3>
                            
                            <div id="faq-icon-{{ $i }}" class="relative flex-none w-8 h-8 flex items-center justify-center transition-transform duration-500 origin-center">
                                <span class="text-3xl font-light text-cielo-sand group-hover:text-cielo-terracotta transition-colors block leading-none">
                                    +
                                </span>
                            </div>
                        </button>
                        
                        <div id="faq-answer-{{ $i }}" 
                             class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out">
                            <div class="text-cielo-navy/80 font-sans font-light text-lg leading-relaxed pb-8 pr-12">
                                {{ __("home.faq.a$i") }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <script>
        function toggleCieloFaq(id) {
            const answer = document.getElementById(`faq-answer-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            
            // Verifica se está aberto checando a classe max-h-0
            const isClosed = answer.classList.contains('max-h-0');

            // 1. Fecha todos os outros (Opcional - Estilo Acordeão)
            // Se quiser que vários fiquem abertos ao mesmo tempo, remova este bloco foreach
            document.querySelectorAll('[id^="faq-answer-"]').forEach(el => {
                if(el.id !== `faq-answer-${id}`) {
                    el.style.maxHeight = '0px';
                    el.classList.add('max-h-0', 'opacity-0');
                    // Reseta o ícone correspondente
                    const otherIconId = el.id.replace('answer', 'icon');
                    document.getElementById(otherIconId)?.classList.remove('rotate-45');
                }
            });

            if (isClosed) {
                // ABRE
                answer.classList.remove('max-h-0', 'opacity-0');
                // scrollHeight pega a altura exata do conteúdo
                answer.style.maxHeight = answer.scrollHeight + "px";
                icon.classList.add('rotate-45');
            } else {
                // FECHA
                answer.style.maxHeight = '0px';
                answer.classList.add('max-h-0', 'opacity-0');
                icon.classList.remove('rotate-45');
            }
        }
    </script>
</section>