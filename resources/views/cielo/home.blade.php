<x-site-layout>
    
    <x-cielo.hero-section />

    {{-- 
        ALTERAÇÕES REALIZADAS:
        1. Adicionei 'mx-2 md:mx-6': Isso cria uma margem lateral. Assim a borda não cola no canto da tela.
           Agora você verá o "arredondado" subindo e o vídeo aparecendo nas laterais.
        2. Mantive 'rounded-t-[5rem]': Para a curva ser bem acentuada no topo.
    --}}
    <div class="relative z-10 mt-[100vh] bg-white shadow-[0_-50px_100px_rgba(0,0,0,0.2)] rounded-t-[3rem] md:rounded-t-[5rem] overflow-hidden mx-2 md:mx-6">
        
        <x-cielo.about-section />
        
        <x-cielo.stats-section />
        
        <x-cielo.properties-section :properties="$energyProperties" />
        
        <x-cielo.expertises-section />

        <x-cielo.partners-section />

        <x-cielo.testimonials-section />

        <x-cielo.blog-section :posts="$posts ?? collect([])" />

        <x-cielo.faq-section />

        <x-cielo.footer-big />

    </div>

</x-cielo-layout>