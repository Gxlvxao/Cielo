<x-site-layout>
    
    {{-- Hero Fixo no Fundo --}}
    <x-cielo.hero-section />

    {{-- 
        CONTEÚDO QUE SOBE SOBRE O HERO
        1. mt-[100vh]: Empurra o conteúdo para baixo da altura da tela inicial.
        2. mx-2 md:mx-6: Cria as margens laterais para ver o vídeo no fundo.
        3. rounded-t-[...]: Cria a curva suave no topo do conteúdo.
    --}}
    <div class="relative z-10 mt-[100vh] bg-white shadow-[0_-50px_100px_rgba(0,0,0,0.2)] rounded-t-[3rem] md:rounded-t-[5rem] overflow-hidden mx-2 md:mx-6">
        
        <x-cielo.about-section />
        
        <x-cielo.stats-section />
        
        {{-- CORREÇÃO AQUI: Mudamos de $energyProperties para $properties --}}
        <x-cielo.properties-section :properties="$properties" />
        
        <x-cielo.expertises-section />

        <x-cielo.partners-section />

        <x-cielo.testimonials-section />

        <x-cielo.blog-section :posts="$posts ?? collect([])" />

        <x-cielo.faq-section />

        <x-cielo.footer-big />

    </div>

</x-site-layout>