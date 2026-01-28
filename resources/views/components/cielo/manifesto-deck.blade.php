@php
    // CONFIGURAÇÃO DOS MANIFESTOS
    // Edite aqui para alterar os vídeos e textos facilmente!
    $manifestos = [
        [
            'title' => 'Essência',
            'subtitle' => 'A alma do lugar',
            'text' => 'Não buscamos apenas paredes, buscamos histórias. Cada imóvel selecionado carrega uma identidade única, onde a arquitetura dialoga com a natureza e o design encontra o propósito.',
            // Vídeo de exemplo (substitua pela URL do seu vídeo na pasta public ou S3)
            'video' => 'https://videos.pexels.com/video-files/3205626/3205626-hd_1920_1080_25fps.mp4', 
        ],
        [
            'title' => 'Harmonia',
            'subtitle' => 'O luxo do bem-estar',
            'text' => 'Acreditamos que o verdadeiro luxo é viver bem. Espaços fluídos, luz natural e materiais orgânicos que elevam a vibração e trazem equilíbrio para o seu dia a dia.',
            'video' => 'https://videos.pexels.com/video-files/7578546/7578546-hd_1920_1080_30fps.mp4',
        ],
        [
            'title' => 'Legado',
            'subtitle' => 'Investimento atemporal',
            'text' => 'Construímos pontes entre o presente e o futuro. Imóveis de alto valor que não são apenas ativos financeiros, mas patrimônios que atravessam gerações.',
            'video' => 'https://videos.pexels.com/video-files/5340763/5340763-hd_1920_1080_25fps.mp4',
        ],
    ];
@endphp

<section id="manifesto-sticky-wrapper" class="relative w-full bg-gray-50">
    
    {{-- 
        CONTAINER STICKY 
        Mantém o efeito de "baralho" enquanto a página rola.
    --}}
    <div class="sticky top-0 h-screen w-full overflow-hidden flex items-center justify-center">

        {{-- Título Fixo no Fundo --}}
        <div class="absolute top-8 left-8 z-0 pointer-events-none opacity-40 mix-blend-multiply">
            <span class="font-sans text-[10px] font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-2 block">
                Manifesto
            </span>
            <h2 class="font-display text-4xl text-cielo-dark leading-none">
                Nossa<br>Visão
            </h2>
        </div>

        {{-- ÁREA DOS CARDS --}}
        <div class="relative w-full h-full p-2 md:p-4 flex items-center justify-center">
            
            @foreach($manifestos as $index => $item)
                {{-- 
                    CARD DE VÍDEO 
                    Mesma física do anterior, mas adaptado para vídeo.
                --}}
                <div 
                    class="manifesto-card absolute inset-2 md:inset-4 bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-gray-100 will-change-transform origin-bottom"
                    style="z-index: {{ $index + 1 }}; transform: translateY(110%);"
                >
                    {{-- VÍDEO (Esquerda) --}}
                    <div class="w-full lg:w-[60%] h-1/2 lg:h-full relative overflow-hidden bg-black">
                        
                        <video 
                            class="absolute inset-0 w-full h-full object-cover opacity-90"
                            autoplay 
                            muted 
                            loop 
                            playsinline
                            poster="{{ asset('images/placeholder.jpg') }}" {{-- Fallback visual --}}
                        >
                            <source src="{{ $item['video'] }}" type="video/mp4">
                            Seu navegador não suporta vídeos.
                        </video>

                        {{-- Overlay sutil para garantir contraste se tiver texto sobre o vídeo --}}
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>

                    {{-- CONTEÚDO (Direita) --}}
                    <div class="w-full lg:w-[40%] h-1/2 lg:h-full bg-white p-8 lg:p-16 flex flex-col justify-center relative">
                        
                        {{-- Número do Slide --}}
                        <div class="absolute top-8 right-8 font-display text-5xl text-gray-100 select-none">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="mb-auto mt-4 lg:mt-12">
                            {{-- Subtítulo / Label --}}
                            <span class="inline-block text-xs font-bold uppercase tracking-widest text-cielo-terracotta mb-4">
                                {{ $item['subtitle'] }}
                            </span>

                            {{-- Título --}}
                            <h3 class="font-display text-4xl lg:text-6xl text-cielo-dark leading-[0.9] mb-8">
                                {{ $item['title'] }}
                            </h3>
                            
                            {{-- Texto do Manifesto --}}
                            <p class="font-sans text-base lg:text-lg text-gray-500 leading-relaxed text-justify">
                                {{ $item['text'] }}
                            </p>
                        </div>

                        {{-- Assinatura Visual (Linha decorativa) --}}
                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <div class="h-1 w-12 bg-cielo-dark"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Barra de Progresso --}}
        <div class="hidden lg:block absolute right-0 top-0 h-full w-1 bg-gray-100 z-50">
            <div id="scroll-progress-bar" class="w-full bg-cielo-terracotta transition-all duration-75 ease-linear h-0"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ATENÇÃO: Se mudar o ID na section, mude aqui também!
    const wrapper = document.getElementById('manifesto-sticky-wrapper');
    const cards = document.querySelectorAll('.manifesto-card');
    const progressBar = document.getElementById('scroll-progress-bar');
    
    // Se por acaso não achar os elementos (ex: em outra página), para o script.
    if (!wrapper || cards.length === 0) return;

    const totalCards = cards.length;
    
    // Altura do Trilho: Cards * 100vh é um bom tamanho para dar tempo de ler.
    wrapper.style.height = `${totalCards * 100}vh`;

    function onScroll() {
        if (window.innerWidth < 1024) return; // Mobile: deixa stackar nativo CSS

        const rect = wrapper.getBoundingClientRect();
        const wrapperTop = rect.top; 
        const wrapperHeight = rect.height;
        const viewportHeight = window.innerHeight;

        const scrolled = -wrapperTop; 
        const scrollableDistance = wrapperHeight - viewportHeight;

        let progress = scrolled / scrollableDistance;
        progress = Math.max(0, Math.min(1, progress));

        if(progressBar) progressBar.style.height = `${progress * 100}%`;

        // Lógica do Baralho
        const stage = progress * (totalCards - 0.1); 
        
        cards.forEach((card, index) => {
            const diff = stage - index;

            if (index === 0) {
                // Primeiro card fixo
                card.style.transform = `translateY(0)`;
                card.style.opacity = '1';
            } else {
                if (diff >= 0) {
                    // Card chegou
                    card.style.transform = `translateY(0)`;
                    card.style.opacity = '1';
                } else {
                    // Card chegando (Animação de entrada suave)
                    if (diff > -1) {
                        const percent = Math.abs(diff) * 100;
                        card.style.transform = `translateY(${percent}%)`;
                        card.style.opacity = `${1 - Math.abs(diff) * 0.5}`; 
                    } else {
                        // Escondido
                        card.style.transform = `translateY(110%)`;
                        card.style.opacity = '0';
                    }
                }
            }
        });
    }

    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                onScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    onScroll();
});
</script>